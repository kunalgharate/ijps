"use strict";
var KTImageInputDemo = {
    init: function() {
        ! function() {
            new KTImageInput("kt_image_1"), new KTImageInput("kt_image_2"), new KTImageInput("kt_image_3"), new KTImageInput("txtFavicon"), new KTImageInput("txtLogo"), new KTImageInput("txtAboutPhoto"), new KTImageInput("txtBannerPhoto");
            var t = new KTImageInput("kt_image_4");
            t.on("cancel", (function(t) {
                swal.fire({
                    title: "Image successfully canceled !",
                    type: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Awesome!",
                    confirmButtonClass: "btn btn-primary font-weight-bold"
                })
            })), t.on("change", (function(t) {
                swal.fire({
                    title: "Image successfully changed !",
                    type: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Awesome!",
                    confirmButtonClass: "btn btn-primary font-weight-bold"
                })
            })), t.on("remove", (function(t) {
                swal.fire({
                    title: "Image successfully removed !",
                    type: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Got it!",
                    confirmButtonClass: "btn btn-primary font-weight-bold"
                })
            }));
            var n = new KTImageInput("kt_image_5");
            n.on("cancel", (function(t) {
                swal.fire({
                    title: "Image successfully changed !",
                    type: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Awesome!",
                    confirmButtonClass: "btn btn-primary font-weight-bold"
                })
            })), n.on("change", (function(t) {
                swal.fire({
                    title: "Image successfully changed !",
                    type: "success",
                    buttonsStyling: !1,
                    confirmButtonText: "Awesome!",
                    confirmButtonClass: "btn btn-primary font-weight-bold"
                })
            })), n.on("remove", (function(t) {
                swal.fire({
                    title: "Image successfully removed !",
                    type: "error",
                    buttonsStyling: !1,
                    confirmButtonText: "Got it!",
                    confirmButtonClass: "btn btn-primary font-weight-bold"
                })
            }))
        }()
    }
};
KTUtil.ready((function() {
    KTImageInputDemo.init()
}));