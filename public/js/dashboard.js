function openDeleteModal(id, title) {
    const modal = document.getElementById("deleteModal");
    modal.style.display = "flex";

    document.getElementById("deleteId").value = id;
    document.getElementById("deleteText").innerText =
        'Are you sure you want to delete "' + title + '"?';
}

function closeModal() {
    document.getElementById("deleteModal").style.display = "none";
}