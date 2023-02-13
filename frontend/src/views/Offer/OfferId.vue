<template>
    <Navbar />
    <div style="max-width: 950px;"
      class="container px-4 pt-8 mx-auto  lg:px-0 dark:bg-gray-900 flex flex-col items-center">
      <div class="flex flex-row w-full">

        <div class="w-full">
          <div class="w-full" v-if="offer && !loading">
            <OfferBoxComponent :jobOffer="{
              job_id: offer.id,
              job_title: offer.title,
              job_description: offer.description,
              salary: offer.salary,
              job_posted_at_datetime_utc: offer.createdAt,
              status: offer.status,
              job_apply_link: offer.jobUrl,
              keywords: offer.keywords,
            }" />
          </div>
          <div v-if="loading" class="flex flex-col items-center shadow-md p-4 mb-8 bg-white" style="min-height: 250px;">
            <div
              class="px-3 py-1 text-xs font-medium leading-none text-center text-red-800 bg-red-200 rounded-full animate-pulse dark:bg-red-900 dark:text-red-200">
              loading...
            </div>
          </div>
          <!-- candidates profile with user avatar -->
          <div style="min-width: 250px;" v-if="isCompany">
            <div class="flex flex-col shadow ml-4">
              <div class="w-full">
                <div v-for="candidate in candidates" :key="candidate.id" class="flex flex-row px-2 py-2 text-xs font-medium mr-2">
                <div class="flex p-4 w-8 h-8 mx-4 items-center justify-center  rounded-full text-purple-700 bg-gray-200" >
                  <p>{{ candidate.name[0] }}{{ candidate.surname[0] }}</p>
                </div>
                <div class="flex flex-row items-center">
                  <p>{{ candidate.name }} {{ candidate.surname }}</p>
                </div>
              </div>

              <div v-if="!loading">
                <button class="w-full flex flex-row items-center justify-end px-2 py-2 text-xs font-medium mr-2">
                  <div class="flex flex-row items-center">
                    <p class="text-purple-700">Select candidate</p>
                  </div>
                  <div class="flex p-4 w-4 h-4 mx-4  items-center justify-center  rounded-full text-purple-700 bg-purple-200" >
                    <p>&#xbb;</p>
                  </div>
                </button>
              </div>

            </div>

            <div>
              <div v-if="candidates?.length === 0" class="flex flex-row px-2 py-2 text-xs font-medium mr-2">
                <div class="flex flex-row items-center">
                  <p>No candidates yet</p>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

      <div class="w-full mb-8 bt-4">

        <!-- add comment input -->
        <div v-if="companyCanComment || freelanceCanComment">

          <form class="flex flex-col  w-full" @submit.prevent="submitComment" >
            <div class="w-full">

              <div class="flex flex-row px-2 py-2 text-xs font-medium mr-2">
                <div class="flex flex-row items-center">
                  <p>Add comment</p>
                </div>
              </div>

              <div class="flex flex-row px-2 py-2 text-xs font-medium mr-4 ">
                <div class="flex flex-row items-center w-full">
                  <textarea v-model="newcomment"
                    class="w-full h-16 p-2 border border-gray-300 rounded-lg focus:outline-none focus:border-purple-400"
                    placeholder="Add your feedback..."></textarea>
                </div>
              </div>

              <div class="flex flex-row px-2 text-xs font-medium mr-2">
                <div class="flex w-full flex-row items-center justify-end">
                  <button type="submit" class="flex flex-row items-center justify-end px-2 py-2 text-xs font-medium mr-2" >
                    <div
                      class="flex p-4 w-4 h-4 mx-4 rounded-full items-center justify-center  rounded-full text-purple-700 bg-purple-200">
                      <p>+</p>
                    </div>
                    <div class="flex flex-row items-center">
                      <p class="text-purple-700">Add comment</p>
                    </div>
                  </button>
                </div>
              </div>
            </div>
          </form>


          <!-- comments list -->

          <div class="flex flex-col">
            <div class="w-full">
              <div class="flex flex-row px-2 py-2 text-xs font-medium mr-2">
                <div class="flex flex-row items-center ml-4">
                  <p>Comments</p>
                </div>
              </div>
              <div v-for="comment in comments" :key="comment.id"
                :ref="el => { divs[i] = el }"
                class="flex flex-row px-2 py-2 text-xs font-medium mr-2">
                <div v-if="comment.author?.company"
                  class="flex p-4 w-8 h-8 mx-4 rounded-full items-center justify-center  rounded-full text-purple-700 bg-gray-200">
                  <p>{{ comment.author?.company?.name[0] }}</p>
                </div>
                <div v-if="comment.author?.freelance"
                  class="flex p-4 w-8 h-8 mx-4 rounded-full items-center justify-center  rounded-full text-purple-700 bg-gray-200">
                  <p>{{ comment.author?.freelance.name[0] }}{{ comment.author?.freelance?.surname[0] }}</p>
                </div>
                <div class="flex flex-row items-center">
                  <p> {{ comment.comment }} </p>
                </div>
              </div>
              <div v-if="!loading">
                <div v-if="comments?.length === 0" class="ml-4 flex flex-row px-2 py-2 text-xs font-medium mr-2">
                  <div class="flex flex-row items-center mb-4">
                    <p>No comments yet</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- comments end -->

      </div>
    </div>
  </div>

</template>

<script>
import { fetchOffer } from "../../stores/offers";
import Navbar from "../../components/General/Navbar.vue";
import OfferBoxComponent from "../../components/General/OfferBoxComponent.vue";
import { getOffersCommentsByOfferId, getOffersCandidatesByOfferId, isCompany, getLoggedUser } from "../../stores/usersFunction";
import { createComment } from "../../stores/comments";
import storage from "../../stores/storage";
import { reactive, ref } from "vue";

export default {
  name: "OfferId",
  components: {
    Navbar
  },
  data() {
    const comments = reactive([]);
    const divs = ref([]);

    return {
      offer: null,
      error: null,
      loading: false,
      comments: null,
      candidates: null,
      isCompany: false,
      user: null,
      newcomment: "",
      companyCanComment: false,
      freelanceCanComment: false,
      offerId: null,
      sendingComment: false,
      comments,
      divs
    };
  },
  mounted() {
    this.initialize();
  },
  onBeforeUpdate() {
      divs.value = [];
  },
  methods: {
    async initialize() {
      this.$route.params.id && (await storage.setItem("currentOfferId", this.$route.params.id));

      this.offerId =  this.$route.params.id || (await storage.getItem("currentOfferId"));

      this.loading = true;

      //get offer comments by id
      if(this.$route.params.id){
        await fetchOffer(this.offerId, this);
        await storage.setItem("currentOffer", this.offer)
      }
      else{
        this.offer = await storage.getItem("currentOffer");
      }


      //get offer candidates by id
      this.candidates = (await getOffersCandidatesByOfferId({ id: this.offerId })).slice(0, 5); //slice to get only 5 candidates

      this.user = await getLoggedUser();
      this.isCompany = isCompany(this.user);
      this.loading = false;

      this.companyCanComment = this.offer?.company?.id === this.user?.company?.id;
      this.freelanceCanComment = this.offer?.selectedCandidate?.id === this.user?.freelance?.id;
    },
    async submitComment() {
      this.sendingComment= true;
      const comment = {
        comment: this.newcomment,
        offer: `/api/offers/${this.offerId}`,
        author: this.user["@id"],
      };

      const res = await createComment(comment);
      this.sendingComment= false;

      this.comments = [...this.comments, res[0].data];
      this.newcomment = "";

    },
  },
  components: {
    Navbar,
    OfferBoxComponent,
  },
};
</script>
