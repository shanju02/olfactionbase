<template>
    <div class="row">
        <div class="col-lg-9 col-md-9 col-12">
            <select
                name="odor"
                id="odor"
                class="form-select d-inline"
                style="width: 45%"
                @change="getSubOdors"
                v-model="selectedOdor"
            >
                <option value="">Select Odor</option>
                <option v-for="odor in odors" :key="odor.id" :value="odor.id">{{ odor.name }}</option>
            </select>
            <div id="opt" style="width: 10%; display: inline">-AND-</div>
            <select
                name="subodor"
                id="subodor"
                class="form-select d-inline"
                style="width: 45%"
                @change="setSubOdor"
                v-model="selectedSubOdor"
            >
                <option value="">Select Subodor</option>
                <option v-for="subOdor in subOdors" :key="subOdor.id" :value="subOdor.id">{{ subOdor.name }}</option>
            </select>
            <div v-show="errorMsg !== ''" class="mt-2 text-danger">{{ errorMsg }}</div>
        </div>
        <div class="col-lg-3 col-md-3 col-6">
            <button type="button" @click="handleSearch" name="btnSearch" id="btnSearch" class="btn btn-primary w-100">Search</button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'OdorSearch',
    props: {
        odorDataUrl: String,
        subOdorDataUrl: String,
        searchFormUrl: String,
    },
    data() {
        return {
            odors: [],
            subOdors: [],
            selectedOdor: "",
            selectedSubOdor: "",
            errorMsg: ""
        }
    },
    mounted() {
        this.getOdors()
    },
    methods: {
        makeJsonObject(data) {
            if (typeof data === 'string') {
                return JSON.parse(data)
            }
            return data
        },
        getOdors() {
            axios.get(this.odorDataUrl).then((response) => {
                this.odors = this.makeJsonObject(response.data)
            }).catch((err) => {
                console.log(err)
            })
        },
        getSubOdors() {
            this.selectedSubOdor = ""
            this.subOdors = []
            axios.get(this.subOdorDataUrl + '/' + this.selectedOdor).then((response) => {
                this.subOdors = this.makeJsonObject(response.data)
            }).catch((err) => {
                console.log(err)
            })
        },
        setSubOdor() {
            if (this.selectedOdor !== "" && this.selectedSubOdor !== "") {
                this.errorMsg = ""
            } else {
                this.errorMsg = "Please select Odor and Subodor both."
            }
        },
        handleSearch() {
            if (this.selectedOdor !== "" && this.selectedSubOdor !== "") {
                window.location.href = this.searchFormUrl + '?odor=' + this.selectedOdor + '&subodor=' + this.selectedSubOdor
            } else {
                this.errorMsg = "Please select Odor and Subodor both."
            }
        }
    }
};
</script>
<style scoped>

</style>
