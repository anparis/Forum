// $(document).ready(function () {
//     $("#uploadForm").submit(function (event) {
    
//       $.ajax({
//         type: "POST",
//         url: "index.php?ctrl=security&action=fileUpload",
//         data: new FormData(this),
//         dataType: "json",
//         encode: true,
//         success: function(data)
// 		    {
// 			    $(".img-overflow").html(data);
// 		    },
//       });

//       event.preventDefault();

//     });
// });