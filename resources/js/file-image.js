import $ from "jquery";

const updateImageSrc = () => {
  $(".file-input").on("change", function (evt) {
    const imgUrl = URL.createObjectURL(evt.target?.files?.[0]);

    $(this).parent(".fieldset").find(".file-image").attr("src", imgUrl);
  });
};

$(() => {
  updateImageSrc();
});
