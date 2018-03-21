// Send Message to telegram chat (You need to create bot from botfather and get token from there)

$token = 'Your Token';
$baseUrl = "https://api.telegram.org/bot".$token;
$url = $baseUrl . '/sendMessage';

$params=[
        'chat_id'=>'your-chat-id-to-whom-message-will-be-send',
        'text'=>'message',
    ];
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$result = curl_exec($ch);
curl_close($ch);

