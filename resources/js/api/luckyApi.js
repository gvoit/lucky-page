import apiClient from "@/api/api";


const imFeelingLucky = async (access_token) => {
    const { data } = await apiClient.post(route('api.lucky.tryLuck'), {}, { headers: {
        "Authorization" : `Bearer ${access_token}`
    }});
    
    return data.data;
}

const imFeelingLuckyHistory = async (access_token) => {
    const { data } = await apiClient.get(route('api.lucky.history'), { headers: {
        "Authorization" : `Bearer ${access_token}`
    }});
    
    return data.data;
}

const deactivateCurrentToken = async (access_token) => {
    await apiClient.delete(route('api.lucky-page-token.destroy', {token: access_token}), { headers: {
        "Authorization" : `Bearer ${access_token}`
    }});
    
    return ;
}

const createNewToken = async (access_token) => {
    const { data } = await apiClient.post(route('api.lucky-page-token.create'), {}, { headers: {
        "Authorization" : `Bearer ${access_token}`
    }});
    return data;
}


export const luckyApi = {
    imFeelingLucky,
    imFeelingLuckyHistory,
    deactivateCurrentToken,
    createNewToken,
}


