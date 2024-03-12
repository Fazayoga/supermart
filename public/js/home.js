$(document).ready(function() {
    // Variable
    var searchInput = $("input[type='text']");
    var produkList = $(".produk-list");

    // jQuery events
    $("button").on("click", function() {
        searchProduks();
    });

    searchInput.on("keydown", function(event) {
        if (event.key === "Enter") {
            searchProduks();
        }
    });

    // Fungsi pencarian produk
    function searchProduks() {
        var searchTerm = searchInput.val().toLowerCase();
        produkItems.hide().filter(function() {
            return $(this).find("h2").text().toLowerCase().includes(searchTerm);
        }).show();
    
        var visibleProdukItems = $(".produk-item:visible");
        produkList.find("p").toggle(visibleProdukItems.length === 0);
    }
    

    // Blok Kondisional (Kontrol dan Seleksi) untuk dropdown kategori
    $(".category-dropdown").hover(
        function() {
            $(this).find(".category-dropdown-content").slideDown();
        },
        function() {
            $(this).find(".category-dropdown-content").slideUp();
        }
    );

    // Filter produk berdasarkan kategori
    var produkItems = $(".produk-item");
    var categoryLinks = $(".filter-category");

    categoryLinks.on("click", function(e) {
        e.preventDefault();
        var selectedCategory = $(this).data("category");

        // Memfilter produk berdasarkan kategori
        if (selectedCategory === "All") {
            produkItems.show();
        } else {
            produkItems.hide();
            produkItems.filter("[data-category='" + selectedCategory + "']").show();
        }

        // Menghapus pesan "Tidak Tersedia" jika ada produk yang sesuai dengan kategori
        produkList.find("p").remove();
    });
});