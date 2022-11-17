# To do
- [] button remember me when login
- [] change date if post/topic modified
- [] add an avatar to user
- [] display number of posts per topic
- [X] implement a burger menu



# keeper
<form id="target" action="index.php?ctrl=security&action=fileUpload&id=<?= $user->getId() ?>" method="POST" enctype="multipart/form-data">
        <input id="img-upload" type="file" name="img">
        <input id="img-send" type="submit" name="submitAvatar">
    </form>