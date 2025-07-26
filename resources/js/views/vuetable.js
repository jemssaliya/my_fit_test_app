export const vuetable = {
    data() {
        return {
            css: {
                tableClass: 'table table-striped table-bordered',
                loadingClass: 'loading',
                ascendingIcon: 'glyphicon glyphicon-chevron-up',
                descendingIcon: 'glyphicon glyphicon-chevron-down',
                handleIcon: 'glyphicon glyphicon-menu-hamburger',
                pagination: {
                    infoClass: 'pull-left',
                    wrapperClass: 'pagination vuetable-pagination',
                    activeClass: 'active',
                    disabledClass: 'disabled',
                    pageClass: 'page-item',
                    linkClass: 'page-link',
                    icons: {
                        first: 'fa fa-angle-double-left',
                        prev: 'fa fa-angle-left',
                        next: 'fa fa-angle-right',
                        last: 'fa fa-angle-double-right',
                    },
                },
            }
        }
    }
}
