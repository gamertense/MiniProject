var foodID, btnString = 'cart';

$(document).ready(function () {
    $(".col-sm-4").fadeIn("slow");
    initialLoad();
});

function slideShow() {
    $("#slides").slidesjs({
        width: 740, //Original 940
        height: 240, //Original 528
        play: {
            active: true,
            auto: true,
            interval: 4000,
            swap: true
        }
    });
}

function initialLoad() {
    $('#menu1').addClass('active');
    $('[data-toggle="tooltip"]').tooltip();

    $('button[name="addButton"]').click(function () {
        btnString = 'cart';
        foodID = $(this).val();
    });
    $('button[name="wishButton"]').click(function () {
        foodID = $(this).val();
        btnString = 'wish';
    });
    $('button[name="infoButton"]').click(function () {
        foodID = $(this).val();
        btnString = 'info';
    });

    // Attach a submit handler to the form
    $("#foodsForm").submit(function (event) {
        // Stop form from submitting normally
        event.preventDefault();
        if (!isLogin && btnString !== 'info') {
            swal(
                'Please login first!',
                '',
                'error'
            );
            return;
        }
        // Send the data using post
        var posting;
        if (btnString === 'cart')
            posting = $.post("php-action/add-cart.php", {hidden_id: foodID});
        else if (btnString === 'info')
            window.location = "food-info.php?fid=" + foodID;
        else
            posting = $.post("php-action/add-wishlist.php", {hidden_id: foodID});
        // Put the results in a div
        posting.done(function (data) {
            if (data === "success-cart") {
                swal(
                    'Added!',
                    'Your selected food has been added to cart',
                    'success'
                ).then(function () {
                    location.reload();
                });
            } else if (data === "success-wishlist") {
                swal(
                    'Added!',
                    'Your selected food has been added to wishlist',
                    'success'
                );
            } else if (data === "already added to wishlist") {
                swal(
                    'Food exists!',
                    'This food is ' + data,
                    'warning'
                );
            } else
                alert(data)
        });
    });
}