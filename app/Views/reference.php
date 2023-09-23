<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action='/save' method='post'>
        <label>studentID</label>
        <input type='hidden' name='id' value="<?php if (isset($fr['id'])) {echo $fr['id'];} ?>">
        <input type='text' name='studentID' value="<?php if (isset($fr['studentID'])) {echo $fr['studentID'];} ?>">
        <br>
        <label>Full Name</label>
        <input type='text' name='FullName' value="<?php if (isset($fr['FullName'])) {echo $fr['FullName'];} ?>">
        <br>
        <label>Year Level</label>
        <input type='text' name='YearLevel' value="<?php if (isset($fr['YearLevel'])) {echo $fr['YearLevel'];} ?>">
        <br>
        <label>Program</label>
        <input type='text' name='Program' value="<?php if (isset($fr['Program'])) {echo $fr['Program'];} ?>">
        <br>
        <input type='submit' value='save'>
    </form>
    <h1>Student List</h1>
    <table border='1'>
        <tr>
            <th>studentID</th>
            <th>Full Name</th>
            <th>Year Level</th>
            <th>Program</th>
            <th>action</th>
        </tr>    
        <?php foreach ($st as $f): ?>
            <tr>
                <td><?= $f['studentID']?></td>
                <td><?= $f['FullName']?></td>
                <td><?= $f['YearLevel']?></td>
                <td><?= $f['Program']?></td>
                <td><a href="/delete/<?= $f['id'] ?>">delete</a> | <a href="/edit/<?= $f['id'] ?>">edit</a></td>
                </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>