<div class="container-fluid">
	<div class="row">
		<h1 class="text-center">All Users</h1>
		<?php
        $result = User::find_user_by_id(2);
		$user = User::instantie($result);
        /*//$result = $user->find_all_users();
		//$result = User::find_user_by_id(2);

		$row = mysqli_fetch_assoc($result);
		$user -> id = $row['id'];
		$user -> username = $row['username'];
		$user -> first_name = $row['first_name'];
		$user -> last_name = $row['last_name'];
		$user -> password = $row['password'];
		/*echo "<br>" . $user->id . "  " . $user->username . "  " . $user->first_name . "  " . $user->last_name . "  " . $user->password . "<br>";*/

        echo "<div class='col-3'>" .
            "    <div class='card'>" .
            "        <div class='card-header h4'> " . $user->id . " " . $user->username . "</div>" .
            "        <div class='card-body h6'>" . $user->first_name  ." " . $user->last_name . " </div>" .
            "    </div>" .
           "</div>";
       /*if( mysqli_num_rows( $result ) ) {
                   while( $row = mysqli_fetch_array( $result ) ) {
               // var_dump( $row );
                // print_r( $row );
                echo "<div class='col-3'>" .
                    "    <div class='card'>" .
                    "        <div class='card-header h4'>" . $row['username'] . "</div>" .
                   "        <div class='card-body h6'>" . $row['first_name'] ." " . $row['last_name'] . "</div>" .
                    "    </div>" .
                    "</div>";
            }
        } else {
            echo "<br>There are no users in the database.<br>";
        }*/
        ?>
		<hr class="pb-3">
		<?php
        $users = User::find_all_users();
        foreach ($users as $user) {
            echo "<br>" . $user->username;
        }
		?>
	</div>
</div>