<?php 
$row = $this->article_model->get(2);		
//stdClass Object ( [body] => Fuzzy Wuzzy was a bear; Fuzzy Wuzzy had no hair. Fuzzy Wuzzy wasn't very fuzzy, was he? [title] => Fuzzy Wuzzy [id] => 2 ) 
//SELECT * FROM (`articles`) WHERE `id` = 2

$row = $this->article_model->get_by('title', 'Fuzzy Wuzzy');
//stdClass Object ( [body] => Fuzzy Wuzzy was a bear; Fuzzy Wuzzy had no hair. Fuzzy Wuzzy wasn't very fuzzy, was he? [title] => Fuzzy Wuzzy [id] => 2 ) 
//SELECT * FROM (`articles`) WHERE `title` = 'Fuzzy Wuzzy'
// NOTE: if more than 1, returns first

$result = $this->article_model->get_many(array(1,3,4));
//Array ( [0] => stdClass Object ( [body] => bears are fuzzy and cute - but don't try to pet them! [title] => Something about bears [id] => 1 ) [1] => stdClass Object ( [body] => This is dumb and boring [title] => Dumb and boring post [id] => 3 ) [2] => stdClass Object ( [body] => This is dumb and boring, too. [title] => Dumb and boring post [id] => 4 ) ) 
//SELECT * FROM (`articles`) WHERE `id` IN (1, 3, 4)  

$result = $this->article_model->get_many_by('title', 'Dumb and boring post');
//Array ( [0] => stdClass Object ( [body] => This is dumb and boring [title] => Dumb and boring post [id] => 3 ) [1] => stdClass Object ( [body] => This is dumb and boring, too. [title] => Dumb and boring post [id] => 4 ) ) 
//SELECT * FROM (`articles`) WHERE `title` = 'Dumb and boring post'

$result = $this->article_model->get_all();
//Array ( [0] => stdClass Object ( [body] => bears are fuzzy and cute - but don't try to pet them! [title] => Something about bears [id] => 1 ) [1] => stdClass Object ( [body] => Fuzzy Wuzzy was a bear; Fuzzy Wuzzy had no hair. Fuzzy Wuzzy wasn't very fuzzy, was he? [title] => Fuzzy Wuzzy [id] => 2 ) [2] => stdClass Object ( [body] => This is dumb and boring [title] => Dumb and boring post [id] => 3 ) [3] => stdClass Object ( [body] => This is dumb and boring, too. [title] => Dumb and boring post [id] => 4 ) [4] => stdClass Object ( [body] => Ain't no sunshine [title] => When she's gone [id] => 13 ) [5] => stdClass Object ( [body] => Woot! [title] => My thoughts [id] => 11 ) [6] => stdClass Object ( [body] => Hello [title] => I must be going [id] => 12 ) ) 
//SELECT * FROM (`articles`)

$count = $this->article_model->count_by('title', 'Dumb and boring post');
//2
//SELECT COUNT(*) AS `numrows` FROM (`articles`) WHERE `title` = 'Dumb and boring post'

$count = $this->article_model->count_all();
//4
//SELECT COUNT(*) AS `numrows` FROM `articles`

$insert_id = $this->article_model->insert(array('body'=>'Woot!', 'title'=>'My thoughts'), FALSE);
//5
//INSERT INTO `articles` (`body`, `title`) VALUES ('Woot!', 'My thoughts')


$insert_array = array(
	array('body'=>'Hello', 'title'=>'I must be going'),
	array('body'=>"When she's gone", 'title'=>"Ain't no sunshine" ),
	);
$insert_ids = $this->article_model->insert_many($insert_array, FALSE);	
//Array ( [0] => 16 [1] => 17 ) //1
//INSERT INTO `articles` (`body`, `title`) VALUES ('When she\'s gone', 'Ain\'t no sunshine')


$update_id = $this->article_model->update(4, array('body'=>'This is dumber and more boring', 'title'=>'Dumber and boringer'));
//1
//UPDATE `articles` SET `body` = 'This is dumber and more boring', `title` = 'Dumber and boringer' WHERE `id` = 4

$update_id = $this->article_model->update_by(array('title'=>'My thoughts'), array('body'=>'Having deeper thoughts'));
//1
//UPDATE `articles` SET `body` = 'Having deeper thoughts' WHERE `title` = 'My thoughts'	

$update_id = $this->article_model->update_many(array(3,4,5), array('body'=>"Oh! I've been updated...and I feel MARVELOUS!"));
//1
//UPDATE `articles` SET `body` = 'Oh! I\'ve been updated...and I feel MARVELOUS!' WHERE `id` IN (3, 4, 5) 	

$update_id = $this->article_model->update_all( array('title'=>"Another dumb title"));
//1
//UPDATE `articles` SET `title` = 'Another dumb title' 	

$delete_id = $this->article_model->delete( 7);
//1
//DELETE FROM `articles` WHERE `id` = 7 

$delete_id = $this->article_model->delete_by( array('body'=>'Hello'));
//1
//DELETE FROM `articles` WHERE `body` = 'Hello' 

$delete_id = $this->article_model->delete_many( array(3,4,5));
//1
//DELETE FROM `articles` WHERE `id` IN (3, 4, 5) 

//// Utilities ////

// dropdown - automatically picks the primary key if only one value passed
$dropdown_array = $this->article_model->dropdown( 'title');
//Array ( [1] => Another dumb title [2] => Another dumb title ) 
//SELECT `id`, `title` FROM (`articles`)


// otherwise, give it a key, value pair to build on (my data is bad for example at this point)
$dropdown_array = $this->article_model->dropdown( 'title', 'body');
//Array ( [Another dumb title] => Fuzzy Wuzzy was a bear; Fuzzy Wuzzy had no hair. Fuzzy Wuzzy wasn't very fuzzy, was he? ) 
//SELECT `title`, `body` FROM (`articles`)
?>
