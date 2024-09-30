import apiClient from "@/api/api";

const register = async (userData) => {
    const { data } = await apiClient.post(route('api.user.register'), userData);
    
    return data;
}


export const userApi = {
    register,
}


