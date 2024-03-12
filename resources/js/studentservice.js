import axios from 'axios';

const API_URL = '/api';

export default {
  getAllStudents() {
    return axios.get(`${API_URL}/students`);
  },
  addStudent(student) {
    return axios.post(`${API_URL}/students`, student);
  },
  deleteStudent(id) {
    return axios.delete(`${API_URL}/students/${id}`);
  }
};