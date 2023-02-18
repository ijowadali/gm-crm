import request from '@/utils/request';

export function getRequest({ url, params }) {
  return request({
    url,
    method: 'get',
    params,
  });
}

export function postRequest({ url, data }) {
  return request({
    url,
    method: 'post',
    data,
  });
}

export function putRequest({ url, data }) {
  return request({
    url,
    method: 'put',
    data,
  });
}

export function deleteRequest(url) {
  return request({
    url,
    method: 'delete',
  });
}
