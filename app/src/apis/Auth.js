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

    redefinePass(form) {        
        return Api().post("/redefine-password", form);
    },

    tokens() {        
        return Api().get("/config/tokens");
    },

    removeToken(item) {        
        return Api().delete("/config/tokens/"+item);
    },

    loadUser() {        
        return Api().get("/config/loadUser");
    },

    updateProfile(form) {        
        return Api().put("/config/users", form);
    },

    uf() {        
        return Api().get("/config/uf");
    },

    city(item) {        
        return Api().get("/config/city/"+item);
    }
}