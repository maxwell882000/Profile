function table_init() {
    let pressTimer;

    $(".longpress").mouseup(function () {
        clearTimeout(pressTimer);
        return false;
    }).mousedown(function () {
        // Set timeout
        let current = this;
        pressTimer = window.setTimeout(function () {
            showing(current)
        }, 600);
        return false;
    });


    window.addEventListener('table_check', function (e) {
        let pressTimer;
        $(".longpress").mouseup(function () {
            clearTimeout(pressTimer);
            return false;
        }).mousedown(function () {
            // Set timeout
            let current = this;
            pressTimer = window.setTimeout(function () {
                showing(current)
            }, 600);
            return false;
        });
    });

    document.addEventListener("DOMContentLoaded", () => {
        Livewire.hook("element.updated", function (e) {
                $(".table_checker").each(function () {
                    let checkBox = $(this).find(".checkbox-show input[type=checkbox]:checked")
                    if (checkBox.length > 0) {
                        $(this).find(".checkbox-show").removeClass("hidden");
                    }
                });
            }
        )
    });

    return {}
}

function findParent(current) {
    return $(current).parents(".table_checker");
}

function showing(current) {
    findParent(current).find('.checkbox-show').removeClass('hidden')
}

function hideCheck(current) {

    findParent(current).find('.checkbox-show').addClass('hidden')
}

function removeChecker(current) {
    findParent(current).find('.checkbox-show input[type=checkbox]').prop('checked', false);
}

function selectAll(current) {
    findParent(current).find('.checkbox-show input[type=checkbox]').prop('checked', true);
}

function setInitWidth() {
    return {
        width: 30,
        getStyle() {
            return `width:${this.width}%`;
        },
        setWidth(event) {
            console.log(event.target.offsetWidth);
        }
    }
}

document.addEventListener('alpine:init', () => {
    Alpine.data('table_draggable', function () {
        return {
            targetNode: null,
            drop_start() {
                this.targetNode = event.target.closest("tr");
            },
            drop_over() {
                event.preventDefault();
            },
            drop_end() {
                const e = event;
                const overTarget = e.target.closest('tr');
                let children = Array.from(e.target.closest('tbody').children);// get all children from tbode
                console.log(overTarget);
                console.log(this.targetNode);
                console.log((e.target.closest('tbody')));
                if (children.indexOf(overTarget) > children.indexOf(this.targetNode))// comparing children index
                {
                    // console.log(this.targetNode);
                    // console.log(overTarget);
                    overTarget.after(this.targetNode); // inserting after the child
                } else {
                    overTarget.before(this.targetNode); // inserting before the child
                    // console.log(this.targetNode);
                    // console.log(overTarget);
                }
                this.$wire.reorder(this.getIndexOfDrag(this.targetNode),
                    this.getIndexOfDrag(overTarget));
            },
            getIndexOfDrag(element) {
                return element.getAttribute('index_of_drag');
            }
        }
    })
});
