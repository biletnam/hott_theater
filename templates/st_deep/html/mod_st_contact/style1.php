<?php 
print '<style type="text/css"><!--' . $addcss . '--></style>';
print '<div class="st_contact ' . $mod_class_suffix . '"><form action="' . $url . '" method="post">' . "\n" .
      '<div class="intro_text ' . $mod_class_suffix . '">'.$pre_text.'</div>' . "\n";

if ($myError != '') {
  print $myError;
}

print '<div class="st-contact-form st-contact-style-1">';

// print anti-spam
if ($enable_anti_spam) {
  if ($anti_spam_position == 0) {
    print '<div class="row-fluid"><div class="span4"><label>' . $myAntiSpamQuestion . '</label><input class="spam inputbox ' . $mod_class_suffix . '" type="text" name="rp_anti_spam_answer" size="' . $emailWidth . '" value="'.$CORRECT_ANTISPAM_ANSWER.'" placeholder="'.$myAntiSpamQuestion.'"/></div>' . "\n";
  }
}
// print email input
print '<div class="span4"><label>' . $myEmailLabel  . '</label><input class="email inputbox ' . $mod_class_suffix . '" type="text" name="rp_email" size="' . $emailWidth . '" value="'.$CORRECT_EMAIL.'" placeholder="'.$myEmailLabel.'"/></div>' . "\n";
// print subject input
print '<div class="span4"><label>' . $mySubjectLabel  . '</label><input class="subject inputbox ' . $mod_class_suffix . '" type="text" name="rp_subject" size="' . $subjectWidth . '" value="'.$CORRECT_SUBJECT.'" placeholder="'.$mySubjectLabel.'"/></div></div>' . "\n";
// print message input
print '<div><label>' . $myMessageLabel  . '</label><textarea class="message textarea ' . $mod_class_suffix . '" name="rp_message" cols="' . $messageWidth . '" rows="4"  placeholder="'.$myMessageLabel.'">'.$CORRECT_MESSAGE.'</textarea></div>' . "\n";

//print anti-spam
if ($enable_anti_spam) {
  if ($anti_spam_position == 1) {
   print '<div class="row-fluid"><label>' . $myAntiSpamQuestion . '</lablel><input class=" inputbox ' . $mod_class_suffix . '" type="text" name="rp_anti_spam_answer" size="' . $emailWidth . '" value="'.$CORRECT_ANTISPAM_ANSWER.'" placeholder="'.$myAntiSpamQuestion.'"/></div>' . "\n";
  }
}
// print button
print '<div class="group-button"><input class=" link-button-2 ' . $mod_class_suffix . '" type="submit" value="' . $buttonText . '" style="width: ' . $buttonWidth . '%"/></div></form></div></div>' . "\n";
