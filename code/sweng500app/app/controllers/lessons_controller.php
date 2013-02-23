<?php
/* SWENG500 - Team 3
 * William DiStefano, Dawn Viscuso, Kevin Scheib, David Singer
 *
 * File: lesson_controller.php
 * Description: 
 * Created: Feb 22, 2013
 * Modified: Feb 22, 2013 1:49:02 PM
 * Modified By: Kevin Scheib
*/

class LessonsController extends AppController {
	var $name = 'Lessons';
	
	function index($courseId = null) {
		$this->paginate = array('Lesson' => array('limit' => 10, null, 'order' => array('Lesson.lesson_order' => 'asc')));

        $lessons = $this->paginate('Lesson');
        
        $this->loadModel('Course');
        $this->Course->id = $courseId;
        $course = $this->Course->read();
        $this->set('course', $course);

        $this->set('lessons', $lessons);
	}
	
	function add() {
		if(!empty($this->data)) {
			if($this->Lesson->save($this->data)) {
				$this->Session->setFlash('New Lesson has been added');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Error: New Lesson has not been added');
			}
		}
	}
	
	function edit($id = null) {
		$this->Lesson->id = $id;
		$this->Lesson->read();
		$lesson = $this->Lesson->data;
		$this->set('lesson', $lesson);

		if(!empty($this->data)) {
			if($this->Lesson->save($this->data)) {
				$this->Session->setFlash('Lesson has been updated');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('Error: Lesson has not been updated');
			}
		}
	}
	
	function delete($lessonId = null) {
		if(!empty($lessonId)) {
			$this->Lesson->delete($lessonId);
			$this->Session->setFlash('Lesson ' + $lessonId + " successfully removed.");
			$this->redirect(array('action' => 'index'));
		}
	}
}

?>
