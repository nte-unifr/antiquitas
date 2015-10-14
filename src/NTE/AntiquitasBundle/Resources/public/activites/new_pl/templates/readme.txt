TEMPLATES
- pretext ('consigne') is available through $pretext
- image/object should be called with $this->dobject
- questions are in $questions, and each should be displayed using
		$q->display($over, $showanswers)
for the input and 
		$q->getvar('question');
for the question (prompt) itself.
- in order to display buttons in the admin, the templates should have :
		if(ISADMIN)	echo $q->display_adminbuttons();
