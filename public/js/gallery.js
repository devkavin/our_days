document.addEventListener("DOMContentLoaded", function () {
    var modal = document.getElementById("photoModal");
    var modalImg = document.getElementById("fullSizeImage");
    var closeModal = document.getElementsByClassName("close")[0];
    var deleteForm = document.getElementById("deletePhotoForm");

    document.querySelectorAll(".photo-thumbnail").forEach((img) => {
        img.onclick = function () {
            modal.style.display = "block";
            modalImg.src = this.src;
            deleteForm.action =
                +"/" +
                "profile.photos.destroy" +
                "/" +
                img.getAttribute("data-photo-id");
        };
    });

    closeModal.onclick = function () {
        modal.style.display = "none";
    };

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
});
