<?php
/* SWENG500 - Team 3
 * William DiStefano, Dawn Viscuso, Kevin Scheib, David Singer
 *
 * File: index.ctp
 * Description: This view provides a listing of all courses in the database
 * Created: 2013-02-21
 * Modified: 2013-02-24 18:36
 * Modified By: William DiStefano
*/
?>

<div>
    <h2>All Courses</h2>
    
    <?php
        echo '<p>'. $this->Form->button('Add Course', array('onClick'=>"location.href='".$this->Html->url('/courses/add')."'", 'class'=>'btn btn-primary')) .'</p>';
    ?>
    
    <small>
    <strong>&nbsp;Type:  </strong>
    <?php echo '<strong>'.$this->Html->link('All', array('action'=>'./index')) .'</strong>  |  '; ?>
    <?php echo $this->Html->link('Current', array('action'=>'indexCurrent')) .'  |  '; ?>
    <?php echo $this->Html->link('Archived', array('action'=>'indexArchived')) .'  |  '; ?>
    <?php echo $this->Html->link('Under Development', array('action'=>'indexUnderDevelopment')); ?>
    </small>

<table class="table">
    
    <tr>
         <th><?php echo $this->Paginator->sort('id'); ?></th>
         <th><?php echo $this->Paginator->sort('course_number'); ?></th>
         <th><?php echo $this->Paginator->sort('course_name'); ?></th>
         <th><?php echo $this->Paginator->sort('user_id'); ?></th>
         <th><?php echo $this->Paginator->sort('course_status'); ?></th>
         <th>Actions</th>
     </tr> 

    <?php $x=1; foreach ($courses as $course) : ?>

    <tr>
        <td><?php echo $course['Course']['id']; ?></td>
        <td><?php echo $course['Course']['course_number']; ?></td>
        <td><?php echo $course['Course']['course_name']; ?></td>
		<td><?php echo $course['User']['name']; ?></td>		
        <td>
            <?php 
                switch ($course['Course']['course_status']) {
                    case 'C':
                    	    echo 'Current';
                    	    break;
                    case 'A':
                    	    echo 'Archived';
                    	    break;
                    case 'U':
                    	    echo 'Under Development';
                    	    break;
                    default:
                    	    echo '-';
                }
            ?>
        </td>        
        <td>
            <?php 
            echo $this->Form->button('View', array('onClick'=>"location.href='".$this->Html->url(array('action'=>'view',$course['Course']['id']))."'", 'class'=>'btn btn-info'));
            echo $this->Form->button('Edit', array('onClick'=>"location.href='".$this->Html->url(array('action'=>'edit',$course['Course']['id']))."'", 'class'=>'btn btn-warning'));
            echo $this->Form->button('Delete', array('onClick'=>"location.href='".$this->Html->url(array('action'=>'delete',$course['Course']['id']))."'", 'class'=>'btn btn-danger'));
            ?>
        </td>
    </tr>

    <?php $x++; endforeach; ?>

</table>

    <div align="center" width="100%">
        <?php echo $this->Paginator->prev('<--  Previous Page');?>
        <?php echo $this->Paginator->numbers();?> | 
        <?php echo $this->Paginator->next('Next Page -->'); ?>
    </div>
</div>
