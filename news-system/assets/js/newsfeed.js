<script>
function check(id){
   this.location.href = "?id="+id;
}

function edit(id) {
    document.getElementById("edit-container-"+id).style.display = "block";
}

function add() {
    document.getElementById("add-form").style.display = "block";
    document.getElementById("add-up").style.display = "none";
}

function addHide() {
    document.getElementById("add-form").style.display = "none";   
}

function editHide(id) {
    document.getElementById("edit-container-"+id).style.display = "none";
}
</script>