import methods from "@/services/api/methods";

class QuestionService {
    async getQuestions() {
        const result = await methods.get('question/');
        return result.data.result;
    }
}
export default new QuestionService();