const body = "body";

$(body).delegate('.waves-effect', 'click', function (e) {
    if ($(this).attr('aria-expanded') === 'true') {
        $(this).parent('li').removeClass('mm-active');
        $(this).parent('li').find('ul').removeClass('mm-show');
        $(this).attr('aria-expanded', false);
    } else {
        $(this).parent('li').addClass('mm-active');
        $(this).parent('li').find('ul').addClass('mm-show');
        $(this).attr('aria-expanded', true);
    }
});

$(".delete-ajax").click(function (e) {
    e.preventDefault();
    let url_button = $(this).attr('href');
    let tr = $(this).parents('tr');
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        type: "warning",
        showCancelButton: !0,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        confirmButtonClass: "btn btn-success mt-2",
        cancelButtonClass: "btn btn-danger ml-2 mt-2",
        buttonsStyling: !1
    }).then(function (t) {
        if (t.value) {
            $.ajax({
                url: url_button,
                type: 'GET',
                success: function (res) {
                    if (res.status === 'true') {
                        tr.remove();
                        Swal.fire("Deleted!", res.data, "success")
                    } else {
                        Swal.fire("Not deleted!", res.data, "warning")
                    }
                }
            });
        } else {
            t.dismiss === Swal.DismissReason.cancel && Swal.fire({
                title: "Cancelled",
                text: "Your imaginary file is safe :)",
                type: "error"
            });
        }
    })
});


$(body).delegate(".modal-main-show", "click", function(e){
    e.preventDefault();
    let url = $(this).attr('href');
    let title = $(this).attr('title');
    let size = $(this).attr('size');
    sizeConfigure(size);
    $('.modal-body-main').load(url);
    setTimeout(function (){
        $('.modal-title-main').html(title);
    }, 600);
});

function sizeConfigure(size){
    let name = '#exampleModalScrollable';
    $(name).find('.modal-dialog').removeClass('modal-sm modal-md modal-lg modal-xl');
    $(name).find('.modal-dialog').addClass(size);
}

$(body).delegate( ".saveButton", 'click', function(event) {
    const submitButton = $(this);
    if ( !submitButton.hasClass('disabled') ) {
        let a = submitButton.html();
        submitButton.addClass('disabled');
        submitButton.html("<i class='fa fa-spin fa-spinner fa-spin1_1rem text-danger mr-2'></i> " + a);

        setTimeout(() => {
            submitButton.removeClass('disabled');
            submitButton.html(a);
        }, 5000);
    } else {
        event.preventDefault();
    }
});


$(body).delegate('.right-bar-toggle', 'click', function (event){
    event.preventDefault();
    let href = $(this).attr('href');
    let title = $(this).attr('title');
    $('#right-bar-body').load(href);
    setTimeout(function (){
        $('.right-title').html(title);
    }, 600);
});

$(body).delegate('input', 'blur', function () {
    let val = $(this).val();
    let parent = +$(this).parent('div').length;
    if (parent > 0) {
        let required = $(this).parent('div').hasClass('required');
        if (val === '' && required === true) {
            $(this).css({'border-color': 'rgba(200,4,10,0.84)'});
            $('.help-block').css({'color': 'rgba(200,4,10,0.84)'});
        } else {
            if (val === '' && required === false) {
                $(this).css({'border-color': 'green'});
            } else {
                $(this).css({'border-color': 'rgba(146,150,142,0.84)'});
            }
        }
    }
});

setTimeout(function (){
    $('.title-breadcrumb').html($('title').html());
}, 800);
