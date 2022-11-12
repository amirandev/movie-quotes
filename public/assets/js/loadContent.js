const load_content = $("#load_content");
const sort = $("#sort");
const search = $("#search");

let nextpage = null;
let loadContent = (do_what) => {
    let endpoint = load_content.data("source");

    // if refresh required
    if (do_what == "refresh") load_content.html("<!--make it empty-->");

    $.ajax({
        type: "get",
        url: nextpage && do_what == "next" ? nextpage : endpoint,
        data: {
            sort: sort.val().trim(),
            search: search.val().trim(),
        },
        success: function (response, status) {
            load_content.append(response.html);
            nextpage = response.next_page_url;
            if (response.next_page_url) {
                $("#loadmore").removeClass("hide");
            } else {
                $("#loadmore").addClass("hide");
            }
        },
    });
};

let debounce = (func, timeout = 300) => {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => {
            func.apply(this, args);
        }, timeout);
    };
};

window.onload = loadContent();
document.querySelector("#sort").addEventListener("change", () => loadContent("refresh"));
document.querySelector("#search").addEventListener("input", () => debounce(loadContent("refresh")));
document.querySelector("#loadmore").addEventListener("click", () => loadContent("next"));
