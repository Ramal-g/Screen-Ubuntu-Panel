function Registe(role)
{
    $.ajax({
        url: 'functions/registerButton.php',
        data: {
            createType: role,
        },
        type: 'POST',
        success: function (data) 
        {
            document.location.href = "register.php";
        }
    });
}


function DeleteAccount(id)
{
    $.ajax({
        url: 'functions/deleteUser.php',
        data: {
            id: id,
        },
        type: 'POST',
        success: function (data) 
        {
            document.location.href = "admin.php";
        }
    });
}