import Api from "./Api";

export default {
    register(form) {
        return Api().post("/register", form);
    },

    login(form) {        
        return Api().post("/login", form);
    },

    logout() {        
        return Api().post("/config/logout");
    },

    loadUser() {        
        return Api().get("/config/loadUser");
    },

    updateProfile(form) {        
        return Api().put("/config/users", form);
    }
}