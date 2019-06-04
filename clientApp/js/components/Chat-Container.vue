<template lang="pug">
b-card.bg-light(title="Sample  Chat Test Project")
  b-row
    b-col.mt-5(md=12)
      b-form(@submit="sendMessage")
        .d-flex.justify-content-center
          b-form-group.col-md-6
            b-input-group
              b-form-input(v-model="message")
              b-input-group-append
                b-button(type="submit" variant='success') Send
    b-col(md=12)
      b-table(striped, hover, :items='items', :fields='fields')
</template>

<script>
export default {
  props:{
    fetchUrl:{
      type: String
    },
    storeUrl:{
      type: String
    }
  },
  data(){
    return {
      message:'',
      fields: [
          {
            key: 'created_at',
            label: 'Create Date',
            'class':'fixed-column',
            sortable: true
          },
          {
            key: 'message',
            sortable: false
          },

        ],
        items: []
      }
  },
  methods:{
    sendMessage(e){
      e.preventDefault();
      let bodyFormData = new FormData();
      bodyFormData.set('message', this.message);
      if(this.message != ""){
        axios({
          method: 'post',
          url: this.storeUrl,
          data: bodyFormData,
          config: { headers: {'Content-Type': 'multipart/form-data' }}
        }).then(res=>{
          this.items = res.data
          this.message = ''
        })
      }
    },
    fetchChat(){
      axios.get(this.fetchUrl).then(res=>{
        this.items = res.data
      })
    }
  },
  mounted(){
    this.fetchChat()
    setInterval(()=>{ this.fetchChat() }, 3000);

  }
}
</script>

<style lang="css">
.fixed-column{
  width: 15em;
}
</style>
