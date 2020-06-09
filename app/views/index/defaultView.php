
            <div class="right">
                <form action=""  method="POST">
                    <label for="fname"><?=$label_firstname?></label>
                    <input type="text" name="fname" id="fname" required />
                    <label for="lname"><?=$label_lastname?></label>
                    <input type="text" name="lname" required id="lname" />
                    <label for="email"><?=$label_email?></label>
                    <input type="email" name="email"  required id="email"  />
                    <label for="username"><?=$label_username?></label>
                    <input type="text" name="username"  required id="username"/>
                    <label for="password"><?=$label_password?></label>
                    <input type="password" name="password" required id="password" />
                    <label for="prevelege"><?=$label_prevelege?></label>
                    <input type="Number" min=1 max=3 value=1 required name="prevelege" id="prevelege" />
                    <input type="submit" value='<?=$button_save ?>' name="submit" />
                </form>
            </div>
            <div class="left">
                <table >
                    <thead>
                        <tr>
                            <td><?=$table_title_userid ?></td>
                            <td><?=$table_title_fname ?></td>
                            <td><?=$table_title_lname ?></td>
                            <td><?=$table_title_username ?></td>
                            <td><?=$table_title_email ?></td>
                            <td><?=$table_title_password ?></td>
                            <td><?=$table_title_prevelege ?></td>
                            <td><?=$table_title_control ?></td>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
                        if(isset($users) && !empty($users)){
                            foreach($users as $user){
                                echo '
                                <tr>
                                    <td>'.$user->user_id.'</td>
                                    <td>'.$user->fname.'</td>
                                    <td>'.$user->lname.'</td>
                                    <td>'.$user->username.'</td>
                                    <td>'.$user->email.'</td>
                                    <td>'.$user->password.'</td>
                                    <td>'.$user->prevelege.'</td>
                                    <td><a href="/mvcFramwork/public/index/edite/'.$user->user_id.'">'.$table_control_edite.'</a> - <a href="/mvcFramwork/public/index/delete/'.$user->user_id.'" onClick="return confirm(\'are you sure you want to delete this user\')" >'.$table_control_delete.'</a></td>
                                </tr>
                                ';
                            }
                        }
                       ?> 
                    </tbosy>
                </table>
            </div>            
