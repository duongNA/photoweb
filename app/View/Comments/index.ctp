<table>
  <tr>
    <th>
      ID
    </th>
    <th>
      Comment
    </th>
    <th>
      Status
    </th>
    <th colspan="3">
      Operations
    </th>
  </tr>
    <?php foreach($comments as $comment): ?>
      <tr>

        <td>
        </td>
        <td>
          <?php echo $this->Html->link($comment['Comment']['comment'], array('controller'=>'posts','action'=>'view',$comment['Comment']['post_id']) ); ?>
        </td>

        <td>
          <?php if($comment['Comment']['reported']==0){
              echo '';
          } else {
              echo 'Reported';
          }?>
        </td>
        <td>
          <?php echo $this->Html->link('Edit',array('controller'=>'comments','action'=>'edit',$comment['Comment']['id'])); ?>
        </td>
        <td>
          <?php echo $this->Form->postLink(
                'Delete',
                array('controller'=>'comments','action' => 'delete', $comment['Comment']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
        </td>
        <td>
          <?php if($comment['Comment']['reported']!=0){
              echo $this->Form->postLink(
                'Un report',
                array('controller'=>'comments','action' => 'unban', $comment['Comment']['id']),
                array('confirm' => 'Are you sure?'));
          }
          ?>
        </td>
      </tr>
    <?php endforeach ?>
</table>

<?php echo $this->paginator->numbers()?>
