/// Called by the vote buttons
function vote(id_review, positive, vote_button) {
    let xhr = new XMLHttpRequest();
    xhr.open("get", `/add_vote.php?id_review=${id_review}&positive=${positive}`);

    xhr.onerror = console.error;
    xhr.onload = () => {
        if (xhr.status === 200) {
            let response = JSON.parse(xhr.response);
            if (response.result === "error") {
                console.error(response.error);
            } else if (response.result === "ok") {
                let parent = vote_button.parentElement;
                // Set karma value
                let karma = parent.querySelector(".karma");
                karma.innerHTML = response.new_karma;

                // Set button statuses
                let like = parent.querySelector(".like");
                let dislike = parent.querySelector(".dislike");
                if (response.vote_value === 1) {
                    like.className = "like active";
                    dislike.className = "dislike";
                } else if (response.vote_value === -1) {
                    like.className = "like";
                    dislike.className = "dislike active";
                } else {
                    like.className = "like";
                    dislike.className = "dislike";
                }
            }
        }
    };

    xhr.send();
}


let popup = document.getElementById("form-popup");

function toggle_form() {
    if (popup.className === "visible") {
        popup.className = "";
    } else {
        popup.className = "visible";
    }
}

function close_form() {
    popup.className = "";
}
