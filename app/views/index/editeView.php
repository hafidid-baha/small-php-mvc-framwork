            
                <form action=""  method="POST">
                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" value="<?= $user->fname ?>" required />
                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" value="<?= $user->lname ?>" required id="lname" />
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?= $user->email ?>" required id="email"  />
                    <label for="username">UserName</label>
                    <input type="text" name="username" value="<?= $user->username ?>" required id="username"/>
                    <label for="password">Password</label>
                    <input type="password" name="password" value="<?= $user->password ?>" required id="password" />
                    <label for="prevelege">Prevelege</label>
                    <input type="Number" min=1 max=3 value=1 required name="prevelege" value="<?= $user->prevelege ?>" id="prevelege" />
                    <input type="submit" value='Save'  name="submit" />
                </form>
            
   