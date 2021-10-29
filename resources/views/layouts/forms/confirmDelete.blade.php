<!-- Bootstrap 5 -->
    <div class="modal fade" id="confirmDelete" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Удаление элемента</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>Вы уверены что хотите удалить элемент <span id="currentName"></span>?</p>
                    <form action="{{route(Route::currentRouteName().'.delete')}}" id="confirmDeleteForm" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id" id="currentId" value="">
                    </form>
                    <button type="submit" form="confirmDeleteForm" class="btn btn-outline-danger">Удалить</button>
                    <button class="btn btn-primary"  data-bs-dismiss="modal">Отмена</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        const confirmDelete = document.querySelector("#confirmDelete");
        confirmDelete.addEventListener("show.bs.modal", function (event) {
            const button = event.relatedTarget;

            const idEl = button.getAttribute("data-bs-id");
            const nameEl = button.getAttribute("data-bs-name");

            const currentId = confirmDelete.querySelector("#currentId");
            const currentName = confirmDelete.querySelector("#currentName");

            currentName.textContent = nameEl;
            currentId.value = idEl;
        })
    </script>

