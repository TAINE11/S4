!function() {
    var t = sessionStorage.getItem("__CONFIG__"),
        e = document.getElementsByTagName("html")[0],
        i = {
            theme: "light",
            nav: "vertical",
            layout: {
                mode: "fluid",
                position: "fixed"
            },
            topbar: {
                color: "light"
            },
            menu: {
                color: "dark"
            },
            sidenav: {
                size: "default",
                user: !1
            }
        };

    // Get theme from HTML attribute or use default
    var o = (this.html = document.getElementsByTagName("html")[0], 
             config = Object.assign(JSON.parse(JSON.stringify(i)), {}), 
             this.html.getAttribute("data-bs-theme"));
    config.theme = (null !== o) ? o : i.theme;

    // Get layout from HTML attribute or use default
    o = this.html.getAttribute("data-layout");
    config.nav = (null !== o) ? ("topnav" === o ? "horizontal" : "vertical") : i.nav;

    // Get layout mode from HTML attribute or use default
    o = this.html.getAttribute("data-layout-mode");
    config.layout.mode = (null !== o) ? o : i.layout.mode;

    // Get layout position from HTML attribute or use default
    o = this.html.getAttribute("data-layout-position");
    config.layout.position = (null !== o) ? o : i.layout.position;

    // Get topbar color from HTML attribute or use default
    o = this.html.getAttribute("data-topbar-color");
    config.topbar.color = (null != o) ? o : i.topbar.color;

    // Get sidenav size from HTML attribute or use default
    o = this.html.getAttribute("data-sidenav-size");
    config.sidenav.size = (null !== o) ? o : i.sidenav.size;

    // Get sidenav user from HTML attribute or use default
    o = this.html.getAttribute("data-sidenav-user");
    config.sidenav.user = (null !== o) ? o : i.sidenav.user;

    // Get menu color from HTML attribute or use default
    o = this.html.getAttribute("data-menu-color");
    config.menu.color = (null !== o) ? o : i.menu.color;

    // Store default configuration
    window.defaultConfig = JSON.parse(JSON.stringify(config));

    // Override with session storage config if available
    if (null !== t) {
        config = JSON.parse(t);
    }

    // Set global config
    window.config = config;

    // Set HTML attributes based on config
    e.setAttribute("data-bs-theme", config.theme);
    e.setAttribute("data-layout-mode", config.layout.mode);
    e.setAttribute("data-menu-color", config.menu.color);
    e.setAttribute("data-topbar-color", config.topbar.color);
    e.setAttribute("data-layout-position", config.layout.position);

    // Handle sidenav for vertical layout
    if ("vertical" === config.nav) {
        let t = config.sidenav.size;

        if (window.innerWidth <= 767) {
            t = "full";
        } else if (window.innerWidth <= 1140 && "full" !== self.config.sidenav.size) {
            t = "condensed";
        }

        e.setAttribute("data-sidenav-size", t);

        if (config.sidenav.user && "true" === config.sidenav.user.toString()) {
            e.setAttribute("data-sidenav-user", !0);
        } else {
            e.removeAttribute("data-sidenav-user");
        }
    }
}();
