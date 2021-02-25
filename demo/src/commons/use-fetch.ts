import { isEmpty } from "@/commons/uitils";

interface IHandleResponse {
  isError: boolean;
  isValidate: boolean;
  message: any;
  result: any;
  statusCode: number
}

/**
 * @return object
 */
export function setHeader() {
  let options = {
    // mode: 'cors', // defaults to same-origin
    'Accept': 'application/json',
    'Content-Type': 'application/json'
  } as any;

  const token = localStorage.getItem('token');

  if (!isEmpty(token)) {
    options.Authorization = `Bearer ${JSON.parse(token!)}`
  }

  return options;
}

/**
 * 
 * @param URL: string
 * @param method 
 * @param body 
 */
export async function useFetch(URL: string, method: string = 'GET', body?: object) {
  let options = {
    method: method,
    headers: setHeader()
  } as RequestInit;

  if (method === 'POST' || method === 'PUT') {
    options.body = JSON.stringify(body)
  }

  const response = await fetch(URL, options);
  return await handleResponse(response);
}

/**
 * 
 * @param res: Response
 */
export async function handleResponse(res: Response) {
  let isError = false
  let isValidate = false
  let message = null
  let result = null
  let statusCode = res.status
  let isOk = res.ok

  if (isOk && statusCode >= 200 && statusCode < 300) {
    result = await res.json().catch(err => {
      console.log(err);
      isError = true
      message = "error"
    });
  }

  if (!isOk && statusCode === 422) {
    isValidate = true;
    message = await res.json();
  }

  if (!isOk && statusCode === 404) {
    isError = true;
    message = res.statusText;
  }

  if (!isOk && statusCode === 401) {
    isError = true;
    message = 'Token Expired';
  }

  if (!isOk && statusCode === 500) {
    isError = true;
    message = res.statusText;
  }

  return { isError, isValidate, message, result, statusCode } as IHandleResponse;
}
