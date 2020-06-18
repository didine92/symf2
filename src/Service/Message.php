<?php

namespace App\Service;
use Psr\Log\LoggerInterface;

class Message
{
		
	public function NoteMessage($note, $student) {
	
		$message = 'Salut'.$student.'vous avez eu la note de '.$note;
		return $message;
	}
}