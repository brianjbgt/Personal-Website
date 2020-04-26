var jdesc = new Vue({
    el: "#jobdesc",
    data: {
        inputs: [{name: ''}]
    },
    methods: {
        add(index) {
            this.inputs.push({ name: '' });
        },
        remove(index) {
            this.inputs.splice(index, 1);
        }
    }
});

export {jdesc};