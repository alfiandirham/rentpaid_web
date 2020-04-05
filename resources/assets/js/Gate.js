export default class Gate {

    constructor(user) {
        this.user = user;
    }


    isAdmin() {
        return this.user.type === 'admin';
    }

    isAuthor() {
        return this.user.type === 'superuser';
    }

    isUser() {
        return this.user.type === 'user';
    }
    isAdminOrAuthor() {
        if (this.user.type === 'admin' || this.user.type === 'superuser') {
            return true;
        }

    }
    isAuthorOrUser() {
        if (this.user.type === 'user' || this.user.type === 'superuser') {
            return true;
        }

    }
}
