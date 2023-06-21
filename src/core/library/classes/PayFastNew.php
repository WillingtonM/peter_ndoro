<?php

$exc_form_data  = ['api_action', 'submit', 'token', 'passphrase', 'version', 'merchant-id', 'timestamp'];
$actions_data   = ['pause', 'unpause', 'cancel', 'update', 'fetch', 'adhoc'];


class PF_API
{
  public $token;
  public $action;
  public $pfData;
  public $timestamp;
  public $payload;
  public $pfParamString;
  public $exc_form_data;
  public $actions_data;
  public $date_ts;
  public $signature;

  function __construct($ext_pfData = array(), $action = '', $token = '')
  {
    // Sort the array alphabetically by key
    ksort( $ext_pfData );
    $this->date_ts        = new DateTime();
    // $this->timestamp      = date($this->date_ts->format(DATE_ISO8601));
    $this->timestamp      = date( 'Y-m-d' ) . 'T' . date( 'H:i:s' );
    $this->pfData         = $ext_pfData;
    $this->action         = $action;
    $this->token          = ( $token != '' )?$token . '/':'';
    $this->payload        = '';
    $this->pfParamString  = '';
    $this->exc_form_data  = ['api_action', 'submit', 'token', 'passphrase', 'version', 'merchant-id', 'timestamp'];
    $this->actions_data   = ['pause', 'unpause', 'cancel', 'update', 'fetch', 'adhoc'];

  }


  // token setter
  public function set_token($token) {
    $this->pfData['token'] = $token;
    $this->token = ($token!='')?$token . '/':'';
  }

  // token getter
  public function get_token() {
    return $this->token;
  }

  // timestamp setter
  public function set_timestamp($timestamp) {
    $this->timestamp = $timestamp;
  }

  // timestamp getter
  public function get_timestamp() {
    return $this->timestamp;
  }

  // pfData setter
  public function set_pfData($ext_pfData)
  {
    ksort( $ext_pfData );
    $this->pfData = $ext_pfData;
  }

  // pfData getter
  public function get_pfData()
  {
    $pfData = $this->pfData;
    $pfData['timestamp'] = $this->timestamp;
    // Strip any slashes in data
    if (is_array($pfData) || is_object($pfData)) {
      foreach ( $pfData as $key => $val )
        $pfData[$key] = ( is_array($val) )? $val : stripslashes($val);
    }

    $this->pfData = $pfData;
    // Return "false" if no data was received
    if( sizeof( $pfData ) == 0 )
      return( false );
    else
      return( $pfData );

  }

  // Normalise the array into a parameter string & make signature
  public function get_signature()
  {
    $pfParamString  = $this->pfParamString;
    $pf_data        = $this->pfData;

    foreach( $pf_data as $key => $val )
    {
      if( !empty($val) && $key != 'api_action' && $key != 'submit' && $key != 'token' )
      {
        $pfParamString .= $key .'='.  ( (is_array($val))? json_encode($val): urlencode(trim($val)) )  .'&';
        // $pfParamString .= $key .'='. urlencode( trim( $val ) ) .'&';
      }
    }

    // Remove the last '&amp;' from the parameter string
    $pfParamString    = substr( $pfParamString, 0, -1 );
    $this->signature  = md5( $pfParamString );
    $this->pfData['signature'] = $this->signature;
    // Create the hashed signature from the url-encoded string
    return $this->signature;
  }

  // Set the method, based on the action, and display
  function set_method()
  {
    switch ( $this->action )
    {
      case 'fetch':
        return 'GET';
        break;
      case 'pause':
      case 'unpause':
      case 'cancel':
        return 'PUT';
        break;
      case 'update':
        return 'PATCH';
        break;
      case 'adhoc':
        return 'POST';
        break;
      default:
        break;
    }
  }

  public function get_payload()
  {
    // Ensure POSTFIELDS does not include unnecessary fields
    $payload = $this->payload;
    $exclude = $this->exc_form_data;
    $pf_data = $this->pfData;

    foreach( $pf_data as $key => $val )
    {
      if( !empty($val) && !in_array($key, $exclude))
      {
        $payload .= $key .'='.  ( (is_array($val))? json_encode($val): urlencode(trim($val)) )  .'&';
      }
    }

    // Remove the last '&amp;' from the payload string
    $this->payload = substr( $payload, 0, -1 );
    return $this->payload;
  }

  public function get_finalData() {
    $pf_data = $this->pfData;
    $pf_data['signature'] = $this->signature;
    return $this->pfData = $pf_data;
  }

  public function subscriptions()
  {
    // Configure curl
    $action = $this->action;
    if ($action == 'ping') {
      $ch = curl_init( 'https://api.payfast.co.za/ping' );
    } elseif ($action == 'adhoc') {
      $ch = curl_init( "https://api.payfast.co.za/subscriptions/". $this->token . '/adhoc' . ((!PF_LIVE)?'?testing=true':''));
    } else {
      $ch = curl_init( 'https://api.payfast.co.za/subscriptions/' . $this->token . $this->action . ((!PF_LIVE)?'?testing=true':'') );
    }
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch, CURLOPT_HEADER, false );
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
    curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, $this->set_method( $this->action ) );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $this->payload );
    curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
        'version: ' .       $_ENV['PF_VERSION'],
        'merchant-id: ' .   $_ENV['PF_MERCHANT_ID'],
        'signature: ' .     $this->signature,
        'timestamp: ' .     $this->timestamp
    ) );

    // Execute and close cURL
    $response = curl_exec( $ch );
    curl_close( $ch );

    return $response;
  }

}


function get_pfData($pfData)
{
  // Strip any slashes in data
  if (is_array($pfData) || is_object($pfData)) {
    foreach ( $pfData as $key => $val ) {
      $pfData[$key] = ( is_array($val) )? $val : stripslashes($val);
    }
  }

  // Return "false" if no data was received
  if( sizeof( $pfData ) == 0 )
    return( false );
  else
    return( $pfData );
}

// Normalise the array into a parameter string & make signature
function get_signature($pfData)
{
  $pfParamString    = '';

  foreach( $pfData as $key => $val )
  {
    if( !empty($val) && $key != 'api_action' && $key != 'submit' && $key != 'token' )
    {
      $pfParamString .= $key .'='.  ( (is_array($val))? json_encode($val): urlencode(trim($val)) )  .'&';
      // $pfParamString .= $key .'='. urlencode( trim( $val ) ) .'&';
    }
  }

  // Remove the last '&amp;' from the parameter string
  $pfParamString    = substr( $pfParamString, 0, -1 );
  $signature        = md5( $pfParamString );
  // Create the hashed signature from the url-encoded string
  return $signature;
}

// Set the method, based on the action, and display
function set_method($action)
{
  switch ( $action )
  {
    case 'fetch':
      return 'GET';
      break;
    case 'pause':
    case 'unpause':
    case 'cancel':
      return 'PUT';
      break;
    case 'update':
      return 'PATCH';
      break;
    case 'adhoc':
      return 'POST';
      break;
    default:
      break;
  }
}

function get_payload($pfData)
{
  global $exc_form_data;

  $payload = '';
  foreach( $pfData as $key => $val )
  {
    if( !empty($val) && !in_array($key, $exc_form_data))
    {
      $payload .= $key .'='.  ( (is_array($val))? json_encode($val): urlencode(trim($val)) )  .'&';
    }
  }

  // Remove the last '&amp;' from the payload string
  $payload = substr( $payload, 0, -1 );
  return $payload;
}

function subscriptions($pfData, $action, $token)
{
  ksort($pfData);
  $pfData     = get_pfData($pfData);
  $signature  = get_signature($pfData);
  // $pfData['Signature'] = $signature
  $payload    = get_payload($pfData);
  $token      = ( $token != '' )?$token . '/':'';

  if ($action == 'ping') {
    $ch = curl_init( 'https://api.payfast.co.za/ping' );
  } elseif ($action == 'adhoc') {
    $ch = curl_init( "https://api.payfast.co.za/subscriptions/". $token . 'adhoc' . ((!PF_LIVE)?'?testing=true':''));
  } else {
    $ch = curl_init( 'https://api.payfast.co.za/subscriptions/' . $token . $action . ((!PF_LIVE)?'?testing=true':'') );
  }

  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
  curl_setopt( $ch, CURLOPT_HEADER, false );
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
  curl_setopt( $ch, CURLOPT_TIMEOUT, 60 );
  curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, set_method( $action ) );
  curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
  curl_setopt( $ch, CURLOPT_VERBOSE, 1 );
  curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
      'version: ' .       $_ENV['PF_VERSION'],
      'merchant-id: ' .   $_ENV['PF_MERCHANT_ID'],
      'signature: ' .     $signature,
      'timestamp: ' .     $pfData['timestamp']
  ) );

  // Execute and close cURL
  $response = curl_exec( $ch );
  curl_close( $ch );

  return $response;
}
