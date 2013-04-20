<table>
  <tr>
    <th>
      ID
    </th>
    <th>
      Username
    </th>
    <th>
      Email
    </th>
    <th>
      Role
    </th>
    <th>
      Status
    </th>
    <th colspan="3">
      Operations
    </th>
  </tr>
    <?php foreach($users as $user): ?>
      <tr>

        <td>
        </td>
        <td>
          <?php echo $user['User']['username']; ?>
        </td>
        <td>
          <?php echo $user['User']['email']; ?>
        </td>
        <td>
          <?php echo $user['User']['role'] ?>
        </td>
        <td>
          <?php if($user['User']['banned']==0){
              echo 'Active';
          } else {
              echo 'Banned';
          }?>
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
        <td>
          <?php if($user['User']['banned']==0){
              echo $this->Form->postLink(
                'Ban',
                array('controller'=>'users','action' => 'ban', $user['User']['id']),
                array('confirm' => 'Are you sure?'));
          } else {
              echo $this->Form->postLink(
                'Unban',
                array('controller'=>'users','action' => 'unban', $user['User']['id']),
                array('confirm' => 'Are you sure?'));
          }
          ?>
        </td>
      </tr>
    <?php endforeach ?>
</table>
<?php echo $this->paginator->numbers()?>
