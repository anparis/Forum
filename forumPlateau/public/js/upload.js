$(document).ready(function () {
    $("form").submit(function (event) {
      var formData = {
        name: $("#img-upload").val(),
      };
    
      $.ajax({
        type: "POST",
        url: "index.php?ctrl=security&action=fileUpload",
        data: formData,
        dataType: "json",
        encode: true,
      }).done(function (data) {
        console.log(data);
      });

      event.preventDefault();

    });
});