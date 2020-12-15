<template>
  <div class="hello">
    <div class="api-method">
      <h2 class="method-title">Validate a postcode</h2>
      <h4><span class="http-method">GET</span>
        api.postcodes.io/postcodes/
        <input class="rest-resource" placeholder=":postcode" v-model="code" id="validate-postcode-input">/validate
        <a href="#" class="validate-postcode" @click="validate()">Request</a>
      </h4>
      <pre v-if="validateResp">{{ validateResp }}</pre>
      <br /> <br />
      <h2 class="method-title">Nearest postcodes for postcode</h2>
      <h4><span class="http-method">GET</span>
        api.postcodes.io/postcodes/
        <input class="rest-resource" placeholder=":postcode" v-model="codeForNearest">/nearest
        <a href="#" class="validate-postcode" @click="nearestPostCodes()">Request</a>
      </h4>
      <pre v-if="codeForNearestResp">{{ codeForNearestResp }}</pre>

      <br /> <br />
      <h2 class="method-title">Get nearest outward codes for a given longitude & latitude</h2>
      <h4><span class="http-method">GET</span>
        api.postcodes.io/outcodes
        ?lon=<input class="rest-resource" placeholder=":postcode" v-model="longitude">
        &lat=<input class="rest-resource" placeholder=":postcode" v-model="latitude">
        <a href="#" class="validate-postcode" @click="nearestOutwardCodes()">Request</a>
      </h4>
      <pre v-if="outwardCodesResp">{{ outwardCodesResp }}</pre>

    </div>
  </div>
</template>

<script>
  import axios from 'axios';
export default {
  name: 'HelloWorld',
  data(){
    return {
      code: null,
      codeForNearest: null,
      longitude: null,
      latitude: null,
      validateResp: null,
      codeForNearestResp: null,
      outwardCodesResp: null,
      baseUrl: 'http://127.0.0.1:8000/api'
    }
  },
  methods: {
    validate () {
      if (this.code) {
        axios.get(this.baseUrl+'/validate-postcode?code='+this.code)
                .then(resp => (this.validateResp = resp.data))
      } else {
        alert('Enter code to validate')
      }
    },
    nearestPostCodes () {
      if (this.codeForNearest) {
        axios.get(this.baseUrl+'/nearest-postcodes?code='+this.codeForNearest)
                .then(resp => (this.codeForNearestResp = resp.data))
      } else {
        alert('Enter code to find nearest postcodes')
      }
    },
    nearestOutwardCodes () {
      if (this.longitude && this.latitude) {
        axios.get(this.baseUrl+'/nearest-outward-codes?long='+this.longitude+'&lat='+this.latitude)
                .then(resp => (this.outwardCodesResp = resp.data))
      } else {
        alert('Enter both longitude and latitude to find nearest Outward Codes')
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
  .http-method {
    margin-right: 1em;
    text-decoration: none;
    background-color: #435e67;
    border-radius: 5px;
    padding: 10px;
    font-size: 80%;
    color: #eee;
    display: inline-block;
  }
  .validate-postcode {
    margin-left: 10px;
    text-decoration: none;
    background-color: #ffffff;
    border-radius: 5px;
    border-color: black;
    border-style: solid;
    padding: 10px;
    font-size: 80%;
    color: #000000;
    display: inline-block;
  }
  pre {
    width: 500px;
    display: block;
    padding: 10px;
    margin-left: 33%;
    text-align: left;
    /*margin: 0 0 10.5px;*/
    font-size: 14px;
    line-height: 1.428571429;
    color: #333;
    word-break: break-all;
    word-wrap: break-word;
    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 0;
  }
</style>
