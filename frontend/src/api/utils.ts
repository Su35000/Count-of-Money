export class UtilsApi {
  public static getHeader(): any {
    const token = JSON.parse(sessionStorage.getItem("token") || "{}");
    const header = {
      headers: {
        Authorization: "Bearer " + (token || "noToken"),
      },
    };
    return header;
  }
}
