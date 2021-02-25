import { useFetch } from '@/commons/use-fetch';
export default async function (URL: string, method: string = 'GET', body?: object) {
  const state = { data: [], error: null, fetching: false };

  state.fetching = true
  const res = await useFetch(URL, method, body);
  state.data = res.result.data
  state.fetching = false

  return { ...state };
}