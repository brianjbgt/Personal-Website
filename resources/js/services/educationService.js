import { webInstance } from './configurationService'

var educationService = function() {
    return {
        getAllEducation: function(profileId){
            return webInstance.get('/api/edu/'+profileId);
        },
        saveEducation: function(profileId, data){
            return webInstance.post('/api/edu/'+profileId, data);
        },
        updateEducation: function(educationId, data){
            return webInstance.patch('/api/edu/'+educationId, data)
        },
        deleteEducation: function(educationId){
            return webInstance.delete('/api/edu/'+educationId);
        }
    };
}

export default educationService