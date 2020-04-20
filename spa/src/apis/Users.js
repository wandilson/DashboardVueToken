import Api from "./Api";

export default {
    list() {        
        return Api().get("/config/users");
    },

    create(form) {        
        return Api().post("/config/users", form);
    },

    update(form) {        
        return Api().put("/config/users", form);
    },

    remove(id) {        
        return Api().delete("/config/users/"+id);
    }
}