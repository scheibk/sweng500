<?php
/* SWENG500 - Team 3
 * William DiStefano, Dawn Viscuso, Kevin Scheib, David Singer
 *
 * File: CoursesController.php
 * Description: This controller provides request handling for course roster data
 * Created: 2013-02-21
 * Modified: 2013-02-22
 * Modified By: Dawn Viscuso
*/

class LessonStatusesController extends AppController {

var $name = 'LessonStatuses';



function add($id = null) {
	$record = $this->LessonStatus->find('first', array(
                                     'fields' => 'id',
                             	'conditions' => array('LessonStatus.user_id' => $this->Auth->user('id'), 
                                                                        'LessonStatus.lesson_id' => $id)
                  ));

            if(!$record) {
                   $this->LessonStatus->create();
                   $this->LessonStatus->set(array(
                            'lesson_id' => $id,                   
                            'user_id' => $this->Auth->user('id')
                   ));
                        if ($this->LessonStatus->validates()) {
                            $this->LessonStatus->save($this->data);
                           $this->Session->setFlash('Lesson completed!');
                        }
             }
            else{
                        $errors = $this->LessonStatus->invalidFields();
                        $this->Session->setFlash(implode(',', $errors));
            }
	$this->redirect($this->referer());

}
}
?>