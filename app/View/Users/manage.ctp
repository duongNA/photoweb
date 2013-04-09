<?php
  echo $this->Form->create();
  echo $this->Form->input('searchstring');
  echo $this->Form->end('Search');
?>
<table>
  <tr>
    <th>
      ID
    </th>
    <th>
      User name
    </th>
    <th>
      Joined
    </th>
    <th>
      Email
    </th>
    <th>
      Role
    </th>
    <th colspan="2">
      Operations
    </th>
  </tr>
    <?php foreach($users as $user): ?>
      <tr>

        <td>
        </td>
        <td>
          <?php echo $this->Html->link($user['User']['username'],array('controller'=>'users','action'=>'view',$user['User']['id'])) ; ?>
        </td>
        <td>
          <?php
            echo $user['User']['created'];
          ?>
        </td>
        <td>
          <?php
            echo $user['User']['email'];
          ?>
        </td>
        <td>
          <?php 
            echo $user['User']['role'];
            ?>
        </td>
        <td>
          <?php echo $this->Html->link('Edit',array('controller'=>'users','action'=>'edit',$user['User']['id'])); ?>
        </td>
        <td>
          <?php echo $this->Form->postLink(
                'Delete',
                array('controller'=>'users','action' => 'delete', $user['User']['id']),
                array('confirm' => 'Are you sure?'));
            ?>
        </td>
      </tr>
    <?php endforeach ?>
</table>
<?php echo $this->Paginator->numbers();?>
