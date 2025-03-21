import $, { param } from "jquery";

const getItems = () => {
  $(".show-more-button").on("click", function (evt) {
    evt.preventDefault();

    const $this = $(this);

    const apiRoute = $this.data("route");
    const currentPage = $this.data("currentPage");
    const lastPage = $this.data("lastPage");

    if (apiRoute && currentPage && lastPage && +currentPage < +lastPage) {
      $this.addClass("btn-disabled");
      $this.text("Loading...");

      window
        .axios(apiRoute, {
          params: {
            page: currentPage + 1,
          },
        })
        .then((response) => {
          $("#show-more-list").append(response.data);

          $this.removeClass("btn-disabled");
          $this.text("Show more");

          // The last page is displaying now
          if (currentPage + 1 === lastPage) {
            $this.parent().hide();
          } else {
            $this.data("currentPage", currentPage + 1);
          }
        });
    }
  });
};

$(() => {
  getItems();
});
