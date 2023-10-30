<?php
class Telegram
{
	private $d;
	private $hash;

	function __construct($d)
	{
		$this->d = $d;
	}

	function sendMessage($message="")
	{
		global $config, $config_base;
		$token = $config['telegram']['token'];

		$data_qtri = [
			'chat_id' => '@chatbotnguyennhieu',
			'text' => $message
		];

		file_get_contents("https://api.telegram.org/bot$token/sendMessage?" . http_build_query($data_qtri));
	}
}
?>
