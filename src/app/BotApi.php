<?php 
namespace Romanlazko\Telegram\App;

use Romanlazko\Telegram\App\Entities\Response;
use Romanlazko\Telegram\Exceptions\TelegramException;
use Carbon\Carbon;
use JsonException;
use Symfony\Component\HttpKernel\Exception\HttpException;

/**
 * Class BotApi
 *
 * @method static Response getUpdates(array $data)                      Use this method to receive incoming updates using long polling (wiki). An Array of Update objects is returned.
 * @method static Response setWebhook(array $data)                      Use this method to specify a url and receive incoming updates via an outgoing webhook. Whenever there is an update for the bot, we will send an HTTPS POST request to the specified url, containing a JSON-serialized Update. In case of an unsuccessful request, we will give up after a reasonable amount of attempts. Returns true.
 * @method static Response deleteWebhook(array $data)                   Use this method to remove webhook integration if you decide to switch back to getUpdates. Returns True on success.
 * @method static Response getWebhookInfo()                             Use this method to get current webhook status. Requires no parameters. On success, returns a WebhookInfo object. If the bot is using getUpdates, will return an object with the url field empty.
 * @method static Response getMe()                                      A simple method for testing your bot's auth token. Requires no parameters. Returns basic information about the bot in form of a User object.
 * @method static Response logOut()                                     Use this method to log out from the cloud Bot API server before launching the bot locally. Requires no parameters. Returns True on success.
 * @method static Response close()                                      Use this method to close the bot instance before moving it from one local server to another. Requires no parameters. Returns True on success.
 * @method static Response forwardMessage(array $data)                  Use this method to forward messages of any kind. On success, the sent Message is returned.
 * @method static Response copyMessage(array $data)                     Use this method to copy messages of any kind. The method is analogous to the method forwardMessages, but the copied message doesn't have a link to the original message. Returns the MessageId of the sent message on success.
 * @method static Response sendPhoto(array $data)                       Use this method to send photos. On success, the sent Message is returned.
 * @method static Response sendAudio(array $data)                       Use this method to send audio files, if you want Telegram clients to display them in the music player. Your audio must be in the .mp3 format. On success, the sent Message is returned. Bots can currently send audio files of up to 50 MB in size, this limit may be changed in the future.
 * @method static Response sendDocument(array $data)                    Use this method to send general files. On success, the sent Message is returned. Bots can currently send files of any type of up to 50 MB in size, this limit may be changed in the future.
 * @method static Response sendSticker(array $data)                     Use this method to send .webp stickers. On success, the sent Message is returned.
 * @method static Response sendVideo(array $data)                       Use this method to send video files, Telegram clients support mp4 videos (other formats may be sent as Document). On success, the sent Message is returned. Bots can currently send video files of up to 50 MB in size, this limit may be changed in the future.
 * @method static Response sendAnimation(array $data)                   Use this method to send animation files (GIF or H.264/MPEG-4 AVC video without sound). On success, the sent Message is returned. Bots can currently send animation files of up to 50 MB in size, this limit may be changed in the future.
 * @method static Response sendVoice(array $data)                       Use this method to send audio files, if you want Telegram clients to display the file as a playable voice message. For this to work, your audio must be in an .ogg file encoded with OPUS (other formats may be sent as Audio or Document). On success, the sent Message is returned. Bots can currently send voice messages of up to 50 MB in size, this limit may be changed in the future.
 * @method static Response sendVideoNote(array $data)                   Use this method to send video messages. On success, the sent Message is returned.
 * @method static Response sendMediaGroup(array $data)                  Use this method to send a group of photos or videos as an album. On success, an array of the sent Messages is returned.
 * @method static Response sendLocation(array $data)                    Use this method to send point on the map. On success, the sent Message is returned.
 * @method static Response editMessageLiveLocation(array $data)         Use this method to edit live location messages sent by the bot or via the bot (for inline bots). A location can be edited until its live_period expires or editing is explicitly disabled by a call to stopMessageLiveLocation. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method static Response stopMessageLiveLocation(array $data)         Use this method to stop updating a live location message sent by the bot or via the bot (for inline bots) before live_period expires. On success, if the message was sent by the bot, the sent Message is returned, otherwise True is returned.
 * @method static Response sendVenue(array $data)                       Use this method to send information about a venue. On success, the sent Message is returned.
 * @method static Response sendContact(array $data)                     Use this method to send phone contacts. On success, the sent Message is returned.
 * @method static Response sendPoll(array $data)                        Use this method to send a native poll. A native poll can't be sent to a private chat. On success, the sent Message is returned.
 * @method static Response sendDice(array $data)                        Use this method to send a dice, which will have a random value from 1 to 6. On success, the sent Message is returned.
 * @method static Response sendChatAction(array $data)                  Use this method when you need to tell the user that something is happening on the bot's side. The status is set for 5 seconds or less (when a message arrives from your bot, Telegram clients clear its typing status). Returns True on success.
 * @method static Response getUserProfilePhotos(array $data)            Use this method to get a list of profile pictures for a user. Returns a UserProfilePhotos object.
 * @method static Response getFile(array $data)                         Use this method to get basic info about a file and prepare it for downloading. For the moment, bots can download files of up to 20MB in size. On success, a File object is returned. The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>, where <file_path> is taken from the response. It is guaranteed that the link will be valid for at least 1 hour. When the link expires, a new one can be requested by calling getFile again.
 * @method static Response banChatMember(array $data)                   Use this method to kick a user from a group, a supergroup or a channel. In the case of supergroups and channels, the user will not be able to return to the group on their own using invite links, etc., unless unbanned first. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method static Response unbanChatMember(array $data)                 Use this method to unban a previously kicked user in a supergroup or channel. The user will not return to the group or channel automatically, but will be able to join via link, etc. The bot must be an administrator for this to work. Returns True on success.
 * @method static Response restrictChatMember(array $data)              Use this method to restrict a user in a supergroup. The bot must be an administrator in the supergroup for this to work and must have the appropriate admin rights. Pass True for all permissions to lift restrictions from a user. Returns True on success.
 * @method static Response promoteChatMember(array $data)               Use this method to promote or demote a user in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Pass False for all boolean parameters to demote a user. Returns True on success.
 * @method static Response setChatAdministratorCustomTitle(array $data) Use this method to set a custom title for an administrator in a supergroup promoted by the bot. Returns True on success.
 * @method static Response banChatSenderChat(array $data)               Use this method to ban a channel chat in a supergroup or a channel. Until the chat is unbanned, the owner of the banned chat won't be able to send messages on behalf of any of their channels. The bot must be an administrator in the supergroup or channel for this to work and must have the appropriate administrator rights. Returns True on success.
 * @method static Response unbanChatSenderChat(array $data)             Use this method to unban a previously banned channel chat in a supergroup or channel. The bot must be an administrator for this to work and must have the appropriate administrator rights. Returns True on success.
 * @method static Response setChatPermissions(array $data)              Use this method to set default chat permissions for all members. The bot must be an administrator in the group or a supergroup for this to work and must have the can_restrict_members admin rights. Returns True on success.
 * @method static Response exportChatInviteLink(array $data)            Use this method to generate a new invite link for a chat. Any previously generated link is revoked. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns the new invite link as String on success.
 * @method static Response createChatInviteLink(array $data)            Use this method to create an additional invite link for a chat. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. The link can be revoked using the method revokeChatInviteLink. Returns the new invite link as ChatInviteLink object.
 * @method static Response editChatInviteLink(array $data)              Use this method to edit a non-primary invite link created by the bot. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns the edited invite link as a ChatInviteLink object.
 * @method static Response revokeChatInviteLink(array $data)            Use this method to revoke an invite link created by the bot. If the primary link is revoked, a new link is automatically generated. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns the revoked invite link as ChatInviteLink object.
 * @method static Response approveChatJoinRequest(array $data)          Use this method to approve a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
 * @method static Response declineChatJoinRequest(array $data)          Use this method to decline a chat join request. The bot must be an administrator in the chat for this to work and must have the can_invite_users administrator right. Returns True on success.
 * @method static Response setChatPhoto(array $data)                    Use this method to set a new profile photo for the chat. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method static Response deleteChatPhoto(array $data)                 Use this method to delete a chat photo. Photos can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method static Response setChatTitle(array $data)                    Use this method to change the title of a chat. Titles can't be changed for private chats. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method static Response setChatDescription(array $data)              Use this method to change the description of a group, a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Returns True on success.
 * @method static Response pinChatMessage(array $data)                  Use this method to pin a message in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup or ‘can_edit_messages’ admin right in the channel. Returns True on success.
 * @method static Response unpinChatMessage(array $data)                Use this method to unpin a message in a supergroup or a channel. The bot must be an administrator in the chat for this to work and must have the ‘can_pin_messages’ admin right in the supergroup or ‘can_edit_messages’ admin right in the channel. Returns True on success.
 * @method static Response unpinAllChatMessages(array $data)            Use this method to clear the list of pinned messages in a chat. If the chat is not a private chat, the bot must be an administrator in the chat for this to work and must have the 'can_pin_messages' admin right in a supergroup or 'can_edit_messages' admin right in a channel. Returns True on success.
 * @method static Response leaveChat(array $data)                       Use this method for your bot to leave a group, supergroup or channel. Returns True on success.
 * @method static Response getChat(array $data)                         Use this method to get up to date information about the chat (current name of the user for one-on-one conversations, current username of a user, group or channel, etc.). Returns a Chat object on success.
 * @method static Response getChatAdministrators(array $data)           Use this method to get a list of administrators in a chat. On success, returns an Array of ChatMember objects that contains information about all chat administrators except other bots. If the chat is a group or a supergroup and no administrators were appointed, only the creator will be returned.
 * @method static Response getChatMemberCount(array $data)              Use this method to get the number of members in a chat. Returns Int on success.
 * @method static Response getChatMember(array $data)                   Use this method to get information about a member of a chat. Returns a ChatMember object on success.
 * @method static Response setChatStickerSet(array $data)               Use this method to set a new group sticker set for a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
 * @method static Response deleteChatStickerSet(array $data)            Use this method to delete a group sticker set from a supergroup. The bot must be an administrator in the chat for this to work and must have the appropriate admin rights. Use the field can_set_sticker_set optionally returned in getChat requests to check if the bot can use this method. Returns True on success.
 * @method static Response getForumTopicIconStickers(array $data)       Use this method to get custom emoji stickers, which can be used as a forum topic icon by any user. Requires no parameters. Returns an Array of Sticker objects
 * @method static Response createForumTopic(array $data)                Use this method to create a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights. Returns information about the created topic as a ForumTopic object.
 * @method static Response editForumTopic(array $data)                  Use this method to edit name and icon of a topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have can_manage_topics administrator rights, unless it is the creator of the topic. Returns True on success.
 * @method static Response closeForumTopic(array $data)                 Use this method to close an open topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights, unless it is the creator of the topic. Returns True on success.
 * @method static Response reopenForumTopic(array $data)                Use this method to reopen a closed topic in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_manage_topics administrator rights, unless it is the creator of the topic. Returns True on success.
 * @method static Response deleteForumTopic(array $data)                Use this method to delete a forum topic along with all its messages in a forum supergroup chat. The bot must be an administrator in the chat for this to work and must have the can_delete_messages administrator rights. Returns True on success.
 * @method static Response unpinAllForumTopicMessages(array $data)      Use this method to clear the list of pinned messages in a forum topic. The bot must be an administrator in the chat for this to work and must have the can_pin_messages administrator right in the supergroup. Returns True on success.
 * @method static Response answerCallbackQuery(array $data)             Use this method to send answers to callback queries sent from inline keyboards. The answer will be displayed to the user as a notification at the top of the chat screen or as an alert. On success, True is returned.
 * @method static Response answerInlineQuery(array $data)               Use this method to send answers to an inline query. On success, True is returned.
 * @method static Response setMyCommands(array $data)                   Use this method to change the list of the bot's commands. Returns True on success.
 * @method static Response deleteMyCommands(array $data)                Use this method to delete the list of the bot's commands for the given scope and user language. After deletion, higher level commands will be shown to affected users. Returns True on success.
 * @method static Response getMyCommands(array $data)                   Use this method to get the current list of the bot's commands. Requires no parameters. Returns Array of BotCommand on success.
 * @method static Response setChatMenuButton(array $data)               Use this method to change the bot's menu button in a private chat, or the default menu button. Returns True on success.
 * @method static Response getChatMenuButton(array $data)               Use this method to get the current value of the bot's menu button in a private chat, or the default menu button. Returns MenuButton on success.
 * @method static Response setMyDefaultAdministratorRights(array $data) Use this method to change the default administrator rights requested by the bot when it's added as an administrator to groups or channels. These rights will be suggested to users, but they are are free to modify the list before adding the bot. Returns True on success.
 * @method static Response getMyDefaultAdministratorRights(array $data) Use this method to get the current default administrator rights of the bot. Returns ChatAdministratorRights on success.
 * @method static Response editMessageText(array $data)                 Use this method to edit text and game messages sent by the bot or via the bot (for inline bots). On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method static Response editMessageCaption(array $data)              Use this method to edit captions of messages sent by the bot or via the bot (for inline bots). On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method static Response editMessageMedia(array $data)                Use this method to edit audio, document, photo, or video messages. On success, if the edited message was sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method static Response editMessageReplyMarkup(array $data)          Use this method to edit only the reply markup of messages sent by the bot or via the bot (for inline bots). On success, if edited message is sent by the bot, the edited Message is returned, otherwise True is returned.
 * @method static Response stopPoll(array $data)                        Use this method to stop a poll which was sent by the bot. On success, the stopped Poll with the final results is returned.
 * @method static Response deleteMessage(array $data)                   Use this method to delete a message, including service messages, with certain limitations. Returns True on success.
 * @method static Response getStickerSet(array $data)                   Use this method to get a sticker set. On success, a StickerSet object is returned.
 * @method static Response getCustomEmojiStickers(array $data)          Use this method to get information about custom emoji stickers by their identifiers. Returns an Array of Sticker objects.
 * @method static Response uploadStickerFile(array $data)               Use this method to upload a .png file with a sticker for later use in createNewStickerSet and addStickerToSet methods (can be used multiple times). Returns the uploaded File on success.
 * @method static Response createNewStickerSet(array $data)             Use this method to create new sticker set owned by a user. The bot will be able to edit the created sticker set. Returns True on success.
 * @method static Response addStickerToSet(array $data)                 Use this method to add a new sticker to a set created by the bot. Returns True on success.
 * @method static Response setStickerPositionInSet(array $data)         Use this method to move a sticker in a set created by the bot to a specific position. Returns True on success.
 * @method static Response deleteStickerFromSet(array $data)            Use this method to delete a sticker from a set created by the bot. Returns True on success.
 * @method static Response setStickerSetThumb(array $data)              Use this method to set the thumbnail of a sticker set. Animated thumbnails can be set for animated sticker sets only. Returns True on success.
 * @method static Response answerWebAppQuery(array $data)               Use this method to set the result of an interaction with a Web App and send a corresponding message on behalf of the user to the chat from which the query originated. On success, a SentWebAppMessage object is returned.
 * @method static Response sendInvoice(array $data)                     Use this method to send invoices. On success, the sent Message is returned.
 * @method static Response createInvoiceLink(array $data)               Use this method to create a link for an invoice. Returns the created invoice link as String on success.
 * @method static Response answerShippingQuery(array $data)             If you sent an invoice requesting a shipping address and the parameter is_flexible was specified, the Bot API will send an Update with a shipping_query field to the bot. Use this method to reply to shipping queries. On success, True is returned.
 * @method static Response answerPreCheckoutQuery(array $data)          Once the user has confirmed their payment and shipping details, the Bot API sends the final confirmation in the form of an Update with the field pre_checkout_query. Use this method to respond to such pre-checkout queries. On success, True is returned.
 * @method static Response setPassportDataErrors(array $data)           Informs a user that some of the Telegram Passport elements they provided contains errors. The user will not be able to re-submit their Passport to you until the errors are fixed (the contents of the field for which you returned the error must change). Returns True on success. Use this if the data submitted by the user doesn't satisfy the standards your service requires for any reason. For example, if a birthday date seems invalid, a submitted document is blurry, a scan shows evidence of tampering, etc. Supply some details in the error message to make sure the user knows how to correct the issues.
 * @method static Response sendGame(array $data)                        Use this method to send a game. On success, the sent Message is returned.
 * @method static Response setGameScore(array $data)                    Use this method to set the score of the specified user in a game. On success, if the message was sent by the bot, returns the edited Message, otherwise returns True. Returns an error, if the new score is not greater than the user's current score in the chat and force is False.
 * @method static Response getGameHighScores(array $data)               Use this method to get data for high score tables. Will return the score of the specified user and several of his neighbors in a game. On success, returns an Array of GameHighScore objects.
 */

class BotApi 
{

    static $telegram;

	static $proxySettings = [];

	static $curl;

	static $customCurlOptions = [];

	static $returnArray = true;

    static $current_action = '';

	static $chat = [];

	const URL_PREFIX = 'https://api.telegram.org/bot';

	const DEFAULT_STATUS_CODE = 200;

    const NOT_MODIFIED_STATUS_CODE = 304;

    static $actions_need_to_save = [
        'sendMessage',
        'editMessageText',
        'sendMediaGroup',
		'sendPhoto',
    ];

	static $actions_need_delete_reply_markup = [
		'sendMessage',
        'sendMediaGroup',
		'sendPhoto',
	];

    static public function initialize(Telegram $telegram){
        self::$telegram = $telegram;
    }

	static function sendMessages($data): Response
    {
		$results = [];
		
        foreach ($data['chat_ids'] as $chat_id) {
			try{
				$data = [
					'text'          => $data['text'],
					'chat_id'       => $chat_id,
					'parse_mode'    => $data['parse_mode'],
					'reply_markup'  => $data['reply_markup'],
				];
				$results[$chat_id] = self::call('sendMessage', $data);
			}
			catch(TelegramException $exception){
				$results[$chat_id] = $exception->getMessage();
			}
		}
		return Response::fromRequest([
			'ok' => true,
			'results' => $results
		]);
    }

    static function returnInline(array $data): ?Response
    {
        if (self::$telegram->getUpdates()->getCallbackQuery()) {
            return self::editMessageText($data);
        }
        return self::sendMessage($data);
    }

    static function setInputMediaPhoto(array $data): string
    {
		$media = [];
		foreach ($data['media'] as $key => $file_id) {
			if(!empty($file_id) AND $file_id !== '0' AND $key < 9){
				$media[] = ['type' => 'photo', 'media' => $file_id];
			}
		}
		if (($lastMediaIndex = array_key_last($media)) !== null) {
			$media[$lastMediaIndex]['caption'] = $data['text'] ?? null;
			$media[$lastMediaIndex]['parse_mode'] = $data['parse_mode'] ?? null;
		}
		return json_encode($media);
    }

	static public function sendMessageWithMedia(array $data): Response
    {
		if (array_key_exists('media', $data) AND !is_null($data['media']) AND count($data['media']) > 0) {
			$data['media'] = self::setInputMediaPhoto($data);
			return self::sendMediaGroup($data);
		}
		return self::sendMessage($data);
    }

	static function getPhoto(array $data): string
	{
		try {
			$file_path = self::getFile($data)->getResult()->getFilePath();
			return "https://api.telegram.org/file/bot".self::$telegram->token."/{$file_path}";
		}
		catch (TelegramException $e){
			return "https://via.placeholder.com/150";
		}
	}

	static function getChat(array $data)
	{
		if (!isset(self::$chat[$data['chat_id']])) {
			self::$chat[$data['chat_id']] = self::call('getChat', $data);
		}
		return self::$chat[$data['chat_id']];
	}

    /**
     * Return an empty Response
     *
     * No request is sent to Telegram.
     * This function is used in commands that don't need to fire a message after execution
     *
     * @return Response
     */
    public static function emptyResponse(): Response
    {
        return Response::fromRequest(['ok' => true]);
    }

    /**
     * Return an bad empty Response
     *
     * No request is sent to Telegram.
     * This function is used in commands that don't need to fire a message after execution
     *
     * @return Response
     */
    public static function emptyBadResponse(): Response
    {
        return Response::fromRequest(['ok' => false]);
    }

    static public function escapeMarkdown(string $text): string
    {
        if (
            (is_string($text) AND is_array(json_decode($text, true))) OR 
            !(
                (substr_count($text, '[') == substr_count($text, ']')) AND
                (substr_count($text, '_') % 2 === 0 ) AND
                (substr_count($text, '*') % 2 === 0 ) AND
                (substr_count($text, '`') % 2 === 0 )
            )
        ){
            return str_replace(
                ['[', '`', '*', '_',],
                ['\[', '\`', '\*', '\_',],
                $text
            );
        }else {
            return $text;
        }
    }

    static public function Keyboard(array $buttons): string
    {
        return json_encode(array(
			'keyboard' => $buttons,
	        'resize_keyboard' => true,
	        'one_time_keyboard' => false
	    ), JSON_UNESCAPED_UNICODE);
    }

    static public function inlineKeyboard(array $buttons, string $step = '', array $link = null): array
	{
        $inline_data = self::$telegram->getUpdates()->getInlineData()->asArray();
		$vertical_Buttons = [];
		foreach ($buttons as $key => $vertical) {
			$horizontal_Buttons = [];
			foreach ($vertical as $key => $horizontal) {

				$button_text 			= $horizontal[0];
				$inline_data['button'] 	= $horizontal[1];
				$inline_data[$step]	 	= $horizontal[2];

				$horizontal_Buttons[] = array(
					'text'           => $button_text,
					'callback_data'  => implode('|', $inline_data)
				);
			}
			$vertical_Buttons[]	= $horizontal_Buttons;
		}
		if (!is_null($link)) {
			array_unshift(
				$vertical_Buttons,
				$link
			);
		}
		return $vertical_Buttons;
	}

    static public function inlineKeyboardWithLink(array $link, array $buttons = null, string $step = ''): array
	{
        if ($buttons === null) {
            return [[$link]];
        }
        return self::inlineKeyboard($buttons, $step, [$link]);
	}

    static public function inlineCheckbox(array $buttons, string $step = ''): array
	{
		$inline_data 		= self::$telegram->getUpdates()->getInlineData()->asArray();
		$inline_data_step 	= explode(':', $inline_data[$step]);
				
		if(in_array($inline_data['temp'], $inline_data_step)){
			unset($inline_data_step[array_search($inline_data['temp'], $inline_data_step)]);
		}
		else{
			array_push($inline_data_step, $inline_data['temp']);
		}
		
		foreach ($buttons as $key => $vertical) {
			$horizontal_Buttons = [];
			foreach ($vertical as $key => $horizontal) {
				$button_text 				= $horizontal[0];
				$inline_data['button'] 		= $horizontal[1];
				$inline_data['temp']	    = $horizontal[2];
				
				if($horizontal[2] != ''){
					if(in_array($inline_data['temp'], $inline_data_step)){
						$button_text .= hex2bin('E29C85');
					}
					else {
						$button_text .= hex2bin('E29D8C');
					}
				}
				$inline_data[$step] 		= implode(':', $inline_data_step);
				
				$horizontal_Buttons[] = array(
					'text'           => $button_text,
					'callback_data'  => implode('|', $inline_data)
				);
			}
			$vertical_Buttons[]	= $horizontal_Buttons;
		}

		return $vertical_Buttons;
	}

	static public function Calendar(Carbon $date, string $button = 'null', int $workDays = 7){
		$start 			= $date->copy()->firstOfMonth();
		$end 			= $date->copy()->lastOfMonth();
		$weekIndex 		= 2;	
		$daysOfWeek 	= array_slice([
			array('Mon', 'null', ''),
			array('Tue', 'null', ''),
			array('Wed', 'null', ''),
			array('Thu', 'null', ''),
			array('Fri', 'null', ''),
			array('Sat', 'null', ''),
			array('Sun', 'null', '')
		], 0, $workDays);

		$calendar 	= [
			self::MonthCounter($date),
			$daysOfWeek
		];
			
		foreach ($start->toPeriod($end) as $day) {

			$dayOfWeek = $day->format('N');

			if ($dayOfWeek !== 1 AND $dayOfWeek <= $workDays AND $start->format('d') === $day->format('d')) {
				for ($i = 1; $i < $dayOfWeek; $i++){
					$calendar[$weekIndex][$i] = array(' ', 'null', '');
				}
			}

			if ($dayOfWeek <= $workDays) {
				$calendar[$weekIndex][$dayOfWeek] = array($day->format('d'), $button, $day->format('Y-m-d'));
			}

			if ($dayOfWeek < $workDays AND $end->format('d') === $day->format('d')) {
				for ($i = $dayOfWeek+1; $i <= $workDays; $i++){
					$calendar[$weekIndex][$i] = array(' ', 'null', '');
				}
			}

			if ($dayOfWeek == $workDays) {
				$weekIndex++;
			}
		}

		return $calendar;
	}

	static public function MonthCounter(Carbon $month, string $button = 'callback_null')
	{
		$command 			= self::$telegram->getUpdates()->getCallbackQuery()?->getCommand();
		$previous_month 	= clone $month;
		$next_month 		= clone $month;

		$counter = [
			array('<', 						$command, 		$previous_month->modify('-1 month')->format('Y-m-d')), 
			array($month->format('M Y'), 	$button, 		$month->format('Y-m-d')), 
			array('>', 						$command, 		$next_month->modify('+1 month')->format('Y-m-d'))
		];

		return $counter;
	}

	static public function TimeCounter(Carbon $hour, string $button = 'callback_null')
	{
		$command 			= self::$telegram->getUpdates()->getCallbackQuery()?->getCommand();
		$previous_hour 		= clone $hour;
		$next_hour 			= clone $hour;

		$counter = [
			array('<', 						$command, 		$previous_hour->modify('-30 min')->format('H:i')), 
			array($hour->format('H:i'), 	$button, 		$hour->format('H:i')), 
			array('>', 						$command, 		$next_hour->modify('+30 min')->format('H:i'))
		];

		return $counter;

	}

	static public function Counter(?string $count, string $button = 'callback_null', int $min_count = 0, int $max_count = 100)
	{
		$command 	= self::$telegram->getUpdates()->getCallbackQuery()?->getCommand();
		$count 		= $count ?? $min_count;

		$counter = [
			array('<', 						$command, 		$count > $min_count ? $count-1 : $min_count), 
			array($count, 					$button, 		$count), 
			array('>', 						$command, 		$count < $max_count ? $count+1 : $max_count)
		];

		return $counter;
	}

    public static function getCurrentAction(): string
    {
        return static::$current_action;
    }

    static public function __callStatic($apiMethod, $data): ?Response
    {
		self::deleteReplyMarkup($apiMethod, reset($data) ?: []);

        return self::call($apiMethod, reset($data) ?: []);
    }

	static private function deleteReplyMarkup($apiMethod, array $data): void
	{
		if (in_array($apiMethod, static::$actions_need_delete_reply_markup)) {
			try{
				$chat = self::getChat([
					'chat_id' => $data['chat_id'],
				])->getResult();
	
				self::editMessageReplyMarkup([
					'chat_id'       => $chat->getId(),
					'message_id'    => $chat->getLastMessageId(),
				]);
			}catch(TelegramException $e){
				
			}
		}
	}

    static public function call($apiMethod, array $params = null): ?Response
  	{
		static::$current_action = $apiMethod;

        if (isset($params['reply_markup']) AND is_array($params['reply_markup'])) {
            $params['reply_markup'] = json_encode(array("inline_keyboard" => $params['reply_markup']), JSON_UNESCAPED_UNICODE);
        }

		$result = self::executeCurl($apiMethod, $params);

		$response = Response::fromRequest(self::jsonValidate($result));

		if (!$response->getOk()) {
			throw new TelegramException($response->getDescription(), $response->getErrorCode(), $params);
		}

        self::saveResponse($apiMethod, $response);
        
        return $response;
	}

	static private function saveResponse(string $apiMethod, Response $response): void
	{
		$result = $response->getResult();

		if ($result AND in_array($apiMethod, static::$actions_need_to_save)) {
            if (is_array($result)) {
                foreach ($result as $key => $message) {
                    DB::insertMessageRequest($message);
                }
            }
            else if ($result->getMessageId()) {
                DB::insertMessageRequest($result);
            }
        }
	}

	static function setUpCurlOptions(string $apiMethod, array $params = [])
	{
		$options = static::$proxySettings + [
			CURLOPT_URL => self::getUrl().'/'.$apiMethod,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => null,
			CURLOPT_POSTFIELDS => null,
			CURLOPT_TIMEOUT => 5,
		];

		if ($params) {
			$options[CURLOPT_POST] = true;
			$options[CURLOPT_POSTFIELDS] = $params;
		}

		if (!empty(static::$customCurlOptions) && is_array(static::$customCurlOptions)) {
			$options = static::$customCurlOptions + $options;
		}

		return $options;
	}

	static function executeCurl(string $apiMethod, array $params = []): string
	{
        $options = self::setUpCurlOptions($apiMethod, $params);

		$curl = curl_init();

		curl_setopt_array($curl, $options);

		$result = curl_exec($curl);

		if ($result === false) {
			throw new TelegramException(curl_error($curl), curl_errno($curl), $params);
		}

		return $result;
	}

	static function jsonValidate(string $jsonString, bool $asArray = true): array|object
	{
		$json = json_decode($jsonString, $asArray);

		if (json_last_error() != JSON_ERROR_NONE) {
			throw new JsonException("Ошибка валидации JSON: {$jsonString}", json_last_error());
		}

		return $json;
	}

	static function getUrl(): string
	{
		return self::URL_PREFIX.self::$telegram->token;
	}
}

// static function curlValidate($curl, $result = null, $params = null): void
// 	{
// 		if (($httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE)) && !in_array($httpCode, [self::DEFAULT_STATUS_CODE, self::NOT_MODIFIED_STATUS_CODE]) ) {
// 			throw new TelegramException('Ошибка', $httpCode, $params);
// 		}
// 	}

	// static function executeCurl(array $options, array $params)
	// {
    //     $curl = curl_init();
	// 	curl_setopt_array($curl, $options);

	// 	$result = curl_exec($curl);
	// 	self::curlValidate($curl, $result, $params);
	// 	if ($result === false) {
	// 		throw new HttpException(curl_errno($curl), curl_error($curl), null, $options);
	// 	}

	// 	return $result;
	// }