import { webInstance } from './configurationService'

var userService = function() {
    return {
        getAllUser: function(){
            return webInstance.get('/api/users');
        },
        saveUser: function(userId, data){
            return webInstance.post('/api/users/'+userId, data);
        },
        updateUser: function(userId, data){
            return webInstance.patch('/api/users/'+userId, data)
        },
        deleteUser: function(userId){
            return webInstance.delete('/api/users/'+userId);
        }
    };
}

export default userService